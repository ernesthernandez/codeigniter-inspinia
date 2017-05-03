<div class="row">
    <form role="form" id="report-form" class="form-inline" method="POST">
        {input}
                <div class="col-lg-3">
            <p>
            <?=lang("lang_report_report_label")?>
            </p>
            <div  style="height: auto; min-height: 30px;">
                <div id="report-range" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
        </div>
        {/input}
    </form>
</div>
<?php if ($ajax): ?>
    <div class="row">
        <div id="loader-container" class="middle-box text-center animated hide">
            <div class="loader-ajax">
                <div class="error-desc">
                     <?=lang("lang_report_report_loading")?>
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ajax-render">
        </div>
    </div>
</div>

<script>
$(function() {
    $('#report-range').on('apply.daterangepicker', function(ev, picker) {
        $('#report-form').trigger('submit');
     });

     $('#report-form').on('submit', function (e) {
            var form = $(this);

            form.ajaxSubmit({
                url: '{ajax_url}',
                type: 'post',
                dataType: 'html',
                data: {
                    start_date: startDate.format('MM-DD-YYYY'),
                    end_date: endDate.format('MM-DD-YYYY')
                },
                cache: 'false',
                beforeSubmit: function(arr, $form, options) { 
                    $('#loader-container').removeClass('hide');  
                },
                complete: function () {
                    $('#loader-container').addClass('hide');
                },
                success: function(data){

                    $('#ajax-render').fadeIn().html(data);
                },
                error: function(data){
                     $('.response-ajax').addClass('hide');
                }
            });
        return false;
    });
});
</script>
<?php endif ?>



<script>
$(function() {

    function callback(start, end) {
         startDate = start;
         endDate = end;
        $('#report-range span').html(start.format('MMMM D, YYYY') + ' <strong>&nbsp;-&nbsp;</strong> ' + end.format('MMMM D, YYYY'));
    }

    callback(moment().subtract(29, 'days'), moment());

    $('#report-range').daterangepicker({
        format: '<?=lang("lang_report_date_format")?>',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2014',
        maxDate: moment(),
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           '<?=lang("lang_report_today")?>'         : [moment(), moment()],
           '<?=lang("lang_report_yesterday")?>'     : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           //'<?=lang("lang_report_last_7_days")?>'   : [moment().subtract(6, 'days'), moment()],
           //'<?=lang("lang_report_last_30_days")?>'  : [moment().subtract(29, 'days'), moment()],
           '<?=lang("lang_report_this_month")?>'    : [moment().startOf('month'), moment().endOf('month')],
           '<?=lang("lang_report_last_month")?>'    : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-info',
        cancelClass: 'btn-danger',
        separator: ' <?=lang("lang_report_separator")?> ',
        locale: {
            applyLabel: '<?=lang("lang_global_send")?>',
            cancelLabel: '<?=lang("lang_global_cancel")?>',
            fromLabel: '<?=lang("lang_report_from")?>',
            toLabel: '<?=lang("lang_report_to")?>',
            customRangeLabel: '<?=lang("lang_report_between")?>',
            daysOfWeek: ['<?=lang("lang_report_week_su")?>', '<?=lang("lang_report_week_mo")?>', '<?=lang("lang_report_week_tu")?>', '<?=lang("lang_report_week_we")?>', '<?=lang("lang_report_week_th")?>', '<?=lang("lang_report_week_fr")?>','<?=lang("lang_report_week_sa")?>'],
            monthNames: ['<?=lang("lang_global_month_01")?>', '<?=lang("lang_global_month_02")?>', '<?=lang("lang_global_month_03")?>', '<?=lang("lang_global_month_04")?>', '<?=lang("lang_global_month_05")?>', '<?=lang("lang_global_month_06")?>', '<?=lang("lang_global_month_07")?>', '<?=lang("lang_global_month_08")?>', '<?=lang("lang_global_month_09")?>', '<?=lang("lang_global_month_10")?>', '<?=lang("lang_global_month_11")?>', '<?=lang("lang_global_month_12")?>'],
            firstDay: 1
        }
    }, callback);

});
</script>