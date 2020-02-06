<script>
	var DatatableAdvanced = function() {

		// Basic Datatable examples
		var _componentDatatableAdvanced = function() {
			if (!$().DataTable) {
				console.warn('Warning - datatables.min.js is not loaded.');
				return;
			}

			// Setting datatable defaults
			$.extend( $.fn.dataTable.defaults, {
				autoWidth: false,
				columnDefs: [{ 
					orderable: false,
					width: 100,
					targets: [ 5 ]
				}],
				dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
				language: {
					search: '<span>Filter:</span> _INPUT_',
					searchPlaceholder: 'Type to filter...',
					lengthMenu: '<span>Show:</span> _MENU_',
					paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
				}
			});


			// data fetching from ajax
			// $('#memListTable').DataTable( {
			// 	processing : true,
			// 	serverSide : true,
			// 	autoWidth: false,
			// 	order : [],
			// 	ajax: {
			// 		url: '<?php echo base_url('index.php/client_management/getLists'); ?>',
			// 		type: 'POST'
			// 	},
			// 	columnDefs:[
			// 		{
			// 			targets:[4],
			// 			orderable:false,
			// 			width: 100,
			// 		}
			// 	]
            // } );
            var dataTable = $('#dynamic_table').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'order': [],
                    'ajax': {
                        'url': "<?php echo base_url() . 'Backend_team/get_all_data' ?>",
                        'type': 'POST'
                    },
                    'columnDefs': [{
                        "targets": [7],
                        "orderable": false,
                    }]
                })



			// Datatable 'length' options
			$('.datatable-show-all').DataTable({
				lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
			});

			// DOM positioning
			$('.datatable-dom-position').DataTable({
				dom: '<"datatable-header length-left"lp><"datatable-scroll"t><"datatable-footer info-right"fi>',
			});

			// Highlighting rows and columns on mouseover
			var lastIdx = null;
			var table = $('.datatable-highlight').DataTable();
			
			$('.datatable-highlight tbody').on('mouseover', 'td', function() {
				var colIdx = table.cell(this).index().column;

				if (colIdx !== lastIdx) {
					$(table.cells().nodes()).removeClass('active');
					$(table.column(colIdx).nodes()).addClass('active');
				}
			}).on('mouseleave', function() {
				$(table.cells().nodes()).removeClass('active');
			});

			// Columns rendering
			$('.datatable-columns').dataTable({
				columnDefs: [ 
					{
						// The `data` parameter refers to the data for the cell (defined by the
						// `data` option, which defaults to the column being worked with, in
						// this case `data: 0`.
						render: function (data, type, row) {
							return data +' ('+ row[3]+')';
						},
						targets: 0
					},
					{ visible: false, targets: [ 3 ] }
				]
			});

		};
		//
		// Return objects assigned to module
		//
		return {
			init: function() {
				_componentDatatableAdvanced();
			}
		}
	}();

	document.addEventListener('DOMContentLoaded', function() {
		DatatableAdvanced.init()
	});
</script>