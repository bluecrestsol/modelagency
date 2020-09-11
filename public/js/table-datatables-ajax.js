var TableDatatablesAjax = function () {

    var initPickers = function () {
        //init date pickers
        /*$('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });*/
    }

    var handleRecords = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 50, // default record count per page //changed default was 10
                "ajax": {
                    "url": $('#datatable_ajax').attr('data-source'), // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
           /* var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }*/
        });

        /*
        * Agencies Filter
        */
        $('#filter_btn_agencies').on('click', function(e) {
            e.preventDefault();
            grid.setAjaxParam("filter_name_agencies", $('#filter_name_agencies').val());
            grid.setAjaxParam("filter_country_agencies", $('#filter_country_agencies').val());
            grid.getDataTable().ajax.reload();
            grid.clearAjaxParams();
        });

        /*
        * Cutomers Filter
        */
        $('#filter_btn_customers').on('click', function(e) {
            e.preventDefault();
            grid.setAjaxParam("filter_name_customers", $('#filter_name_customers').val());
            grid.setAjaxParam("filter_country_customers", $('#filter_country_customers').val());
            grid.getDataTable().ajax.reload();
            grid.clearAjaxParams();
        });

         /*
        * Models Filter
        */
        $('#filter_btn_models').on('click', function(e) {
            e.preventDefault();
            grid.setAjaxParam("filter_name_models", $('#filter_name_models').val());
            grid.setAjaxParam("filter_agency_models", $('#filter_agency_models').val());
            grid.setAjaxParam("filter_country_models", $('#filter_country_models').val());
            grid.getDataTable().ajax.reload();
            grid.clearAjaxParams();
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            initPickers();
            handleRecords();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesAjax.init();
});