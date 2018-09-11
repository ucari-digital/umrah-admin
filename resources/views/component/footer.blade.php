@php
$title = !empty($title) ? $title : '';
$column = !empty($column) ? $column : "[]"; 
$column_width = !empty($column_width) ? $column_width : "[]";
$header_alignment = !empty($header_alignment) ? $header_alignment : 'center';
$data_table_display = !empty($data_table_display) ? $data_table_display : 'default';
@endphp
{{-- @if($data_table_display == 'default') --}}
<script type="text/javascript">
	$(document).ready(function() {
    	var t = $('.table').DataTable({
    		"columnDefs": [ {
	            "searchable": false,
	            "orderable": false,
	            "targets": 0
	        } ],
	        "order": [[ 1, 'asc' ]],
    		"dom": "<'row mt-4' <'col-md-6'l><'col-md-6'f>><'row justify-content-end' <'col-md-4'<'float-right'B>> ><'table-responsive'tr> <'row mt-2' <'col-md-6'i><'col-md-6'p>>",
    		"scrollX": true,
	        buttons: [
	            {
	                extend: 'pdfHtml5',
	                className : 'btn-primary btn-sm',
	                title: '{{$title}}',
	                text: 'PDF',
	                download: 'open',
	                pageSize: 'A4',
	                exportOptions: {
                    	columns: {{$column}}
                	},
	                customize: function(doc) {
	                	doc.styles.tableHeader = {
							alignment: '{{$header_alignment}}',
							fillColor: '#747A81',
							color: '#FFF',
							bold: true,
							margin: [5, 5]
						}
						doc.styles.defaultStyle = {
							fontSize: '24',
						}
						doc.styles.tableBodyEven = {
							width: '100%',
							margin: [3, 5]
						}
						doc.styles.tableBodyOdd = {
							width: '100%',
							fillColor: '#F4F6F8',
							margin: [3, 5]
						}
						doc.content[1].table.widths = {!! $column_width !!}
					}  
	            }
	        ]
    	});
	    // t.on( 'order.dt search.dt', function () {
	    //     t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	    //         cell.innerHTML = i+1;
	    //         t.cell(cell).invalidate('dom'); 
	    //     } );
	    // } ).draw();
    	$('.dataTables_paginate, .dataTables_wrapper').addClass('mt-2');
	} );
</script>
{{-- @endif --}}

<script>
	$(document).ready(function(){
		// $('.table-pg tbody').paginathing({
		// 	perPage: 5,
		// 	prevNext: true,
		// 	firstLast: true,
		// 	prevText: '&laquo;',
		// 	nextText: '&raquo;',
		// 	firstText: 'First',
		// 	lastText: 'Last',
		// 	containerClass: 'pagination-container mt-2 float-right',
		// 	ulClass: 'pagination',
		// 	liClass: 'page-item',
		// 	activeClass: 'active',
		// 	disabledClass: 'disabled',
		// 	insertAfter: '.place-pg'
		// });
	});
	function searchField() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("inputSearch");
		filter = input.value.toUpperCase();
		table = document.getElementById("tableSearch");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[$('#inputState').val()];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
		
	}
	function print() {
		$("#tablePrint").printMe({ "path": ["{{url('vendor/bootstrap-4.1/bootstrap.min.css')}}","{{url('css/theme.css')}}"]});
	}
	$('.notification').popover({
		html: true,
    	trigger: 'click',
    	content: $('.template-notification').html(),
    	placement: 'bottom',
    	template: 	'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body p-0"></div></div>'
	});
	$('.notification').on('shown.bs.popover', function(){
		$('.popover.fade.bs-popover-bottom.show > .arrow').css('margin-left', '-1px');
	});
	$('.setting').popover({
		html: true,
    	trigger: 'click',
    	content: $('.template-setting').html(),
    	offset: 10,
    	placement: 'bottom',
    	template: 	'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body p-0"></div></div>'
	});
	
	$('body').on('click', function (e) {
	    $('[data-toggle="popover"]').each(function () {
	        //the 'is' for buttons that trigger popups
	        //the 'has' for icons within a button that triggers a popup
	        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
	            $(this).popover('hide');
	        }
	    });
	});
</script>