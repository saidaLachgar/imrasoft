/*

 * To change this license header, choose License Headers in Project
Properties.

* To change this template file, choose Tools | Templates

* and open the template in the editor.

*/

    'use strict';
	var $ = jQuery;
	$.getScript("https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js",	function(){
            $('#example').DataTable( {

                "paging":   true,
                "ordering": true,                               
                "info":     false,
                "iDisplayLength": 10
            } );
           });
