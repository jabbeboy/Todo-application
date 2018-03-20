$(document).ready(function() {

    // Popover
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });

    // Datepicker
    $("#datepicker").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        startDate: new Date()
    }).datepicker('update', new Date('yyyy-mm-dd'));

    // End date from value of datetimepicker for edit.
    var date = new Date($('#end_date').val());

    // Datepicker edit
    $("#datepicker_edit").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        startDate: new Date()
    }).datepicker('update', new Date('yyyy-mm-dd'));
});
