<?php   
    css('assets/theme/css/plugins/daterangepicker/daterangepicker-bs3.css');
    js('assets/theme/js/plugins/fullcalendar/moment.min.js');
    js('assets/theme/js/plugins/daterangepicker/daterangepicker.js');
    if (!isset($datelimit) || !is_numeric($datelimit)) $datelimit  = 60;
 ?>
<div  style="height: auto; min-height: 36px;">
    <div id="datepicker" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #e7eaec; border-radius: 4px; width: 100%">
        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
        <span></span> <i id='datepicker-icon' class="caret"></i>
    </div>
    <input id="range-name" type="hidden" name="range">
</div>

<script>
$(function() {

    function callback(start, end) {
         startDate = start;
         endDate   = end;
        $('#datepicker span').html(start.format('MMMM D, YYYY') + ' <strong>&nbsp;-&nbsp;</strong> ' + end.format('MMMM D, YYYY'));
    }

    callback(moment(), moment());

    $('#datepicker').daterangepicker({
        "alwaysShowCalendars": false,
        format: 'MM/DD/YYYY',
        startDate: moment(),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: moment(),
        dateLimit: { days: <?=$datelimit ?> },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           '<?=lang("lang_report_today")?>'       : [moment(), moment()],
           '<?=lang("lang_report_yesterday")?>'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '<?=lang("lang_report_week")?>'        : [moment().subtract(6, 'days'), moment()],
           '<?=lang("lang_report_currentMonth")?>': [moment().startOf('month'), moment().endOf('month')],
           '<?=lang("lang_report_lastMonth")?>'   : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-danger',
        separator: ' <?=lang("lang_report_to")?> ',
        locale: {
            applyLabel: '<?=lang("lang_global_send")?>',
            cancelLabel: '<?=lang("lang_global_cancel")?>',
            fromLabel: '<?=lang("lang_report_from")?>',
            toLabel: '<?=lang("lang_report_to")?>',
            customRangeLabel: '<?=lang("lang_report_custom")?>',
            daysOfWeek: ['<?=lang("lang_report_week_su")?>', '<?=lang("lang_report_week_mo")?>', '<?=lang("lang_report_week_tu")?>', '<?=lang("lang_report_week_we")?>', '<?=lang("lang_report_week_th")?>', '<?=lang("lang_report_week_fr")?>','<?=lang("lang_report_week_sa")?>'],
            monthNames: ['<?=lang("lang_global_month_01")?>', '<?=lang("lang_global_month_02")?>', '<?=lang("lang_global_month_03")?>', '<?=lang("lang_global_month_04")?>', '<?=lang("lang_global_month_05")?>', '<?=lang("lang_global_month_06")?>', '<?=lang("lang_global_month_07")?>', '<?=lang("lang_global_month_08")?>', '<?=lang("lang_global_month_09")?>', '<?=lang("lang_global_month_10")?>', '<?=lang("lang_global_month_11")?>', '<?=lang("lang_global_month_12")?>'],
            firstDay: 1
        }
    }, callback);

});

 $(document).ready(function(){
    $('.ranges > ul > li').click(function(){
        var current = $(this);
        var range   = current.text().toLowerCase().split(' ').join('_');
        var input   = $('input#range-name');
        input.val(range);
        console.log('range_type:  ' + range);
    });
 });

</script>
<style type="text/css">
<?php if (isset($custom) && isset($custom) == false): ?>
.ranges li:last-child, 
.daterangepicker_start_input, 
.daterangepicker_end_input { display: none; }

<?php endif ?>

<?php if (isset($weekly) && isset($weekly) == true): ?>

.ranges li:nth-child(4), 
.ranges li:nth-child(5)
{ display: none; }

<?php else: ?>
.ranges li:nth-child(3)
{ display: none; }
<?php endif ?>

</style> 
