/*
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function() {
    "use strict";

    $("#dashboard-jobs").dataTable({
        "order": [ 8, 'asc' ],
        "oLanguage": {
         "sSearch": "Filter: "
       }
    });

    // If Job Action Date is past due

    //CONVERSION CHART
    var donut = new Morris.Donut({
        element: 'conversion-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a", '#cccccc'],
        data: [
            {label: "Completed", value: 85},
            {label: "Late", value: 5},
            {label: "Hold", value: 4},
            {label: "Unknown", value: 6}
        ],
        hideHover: 'auto'
    });    

    //The Calendar - set to todays date
    $("#calendar").datepicker({
        todayHighlight: true
    });

    // Filter Jobs
    var table = $('#dashboard-jobs').dataTable();

    $(".job-toggle").on('click', function() {
        var showJobs = $(this).attr("data-show-job");
        $("#dashboard-jobs tbody").removeClass('show-active').removeClass('show-rush').removeClass('show-expedited');
        $("#dashboard-jobs tbody").addClass('show-'+showJobs);

        if (showJobs != 'active') { table.fnLengthChange( 100 ); }
        else { table.fnLengthChange( 10 ); }
    });

});