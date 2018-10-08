@extends('template.master')
@section('title', 'Tambah Proyek: Form Utama')

@section('css')
<style>
.btn-as-text {
    color: #495057;
    border: none;
    box-shadow: none;
    background: transparent;
    cursor: pointer;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
    margin-top: 40px;
}
.stepwizard p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.stepwizard-step .btn.disabled {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.multi-input-control {
    background: #f8f8f8;
    border: none;
    text-align: center;
}
.multi-input-copy-target .fe {
    color: #a19090
}
</style>
@endsection

@section('content')
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-secondary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-secondary btn-circle disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-primary btn-circle disabled">3</a>
            <p>Step 3</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-primary btn-circle disabled">4</a>
            <p>Step 4</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-primary btn-circle disabled">5</a>
            <p>Step 5</p>
        </div>
    </div>
</div>

<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Termin Pembayaran
        </h1>
    </div>

    <div class="row row-cards">
        <div class="col-4">
            <div id="termin-setting" class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Pengaturan Termin
                    </h3>
                    <div class="card-options">
                        <a href="#" class="btn btn-primary btn-sm">Lewati</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-label">Dibayar secara</div>
                        <div class="custom-controls-stacked">
                            <label class="custom-control custom-radio">
                                <input class="periodic-type custom-control-input" name="periodic_type" value="bulanan" type="radio">
                                <div class="custom-control-label">Bulanan</div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input class="periodic-type custom-control-input" name="periodic_type" value="tahunan" type="radio">
                                <div class="custom-control-label">Tahunan</div>
                            </label>
                            <label class="custom-control custom-radio">
                                <input class="periodic-type custom-control-input" name="periodic_type" value="custom" type="radio">
                                <div class="custom-control-label">Custom</div>
                            </label>
                        </div>
                    </div>
                    @include('includes.form-element.datepicker', [
                        'label' => 'Tanggal pertama bayar',
                        'id' => 'first-due-date',
                        'name' => 'first_due_date',
                    ])
                    <div class="form-group">
                        <label class="form-label">Total biaya termin</label>
                        <div class="row gutters-xs">
                            <div class="col">
                                <input id="total-termin-amount" class="form-control" type="text" name="total_termin_amount" data-mask="000.000.000.000.000" data-mask-reverse="true">
                            </div>
                            <span class="col-auto">
                                <button id="total-termin-amount-btn" data-price="100000" class="btn btn-secondary" type="button"><small>Gunakan Harga Proyek</small></button>
                            </span>
                        </div>
                    </div>

                    <button id="selesai-btn" class="btn btn-primary" disabled>Selesai</button>
                </div>
                <!--
                    <div class="card-footer">
                        This is standard card footer
                    </div>
                -->
            </div>
        </div>
        <div class="col-8">
            <div id="termin-dates" class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Tanggal Termin
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-1">
                            No
                        </div>
                        <div class="form-group col-5">
                            Tanggal Penagihan
                        </div>
                        <div class="form-group col-6">
                            Nominal Tagih
                        </div>
                    </div>
                    @component('includes.form-element.multiple-input-custom', [
                        'id' => 'termin-input-date',
                        'name' => 'termin_date[]',
                        'number' => 1,
                    ])
                        <div class="row row-termin-date">
                            <div class="form-group col-1">
                                --iteration--
                            </div>
                            <div class="form-group col-5">
                                <div class="row gutters-xs">
                                    <div class="col-4">
                                        <select name="due_date[year][]" class="due-date-year form-control custom-select">
                                            <option value="">Year</option>
                                            @for ($year = date('Y'); $year <= date('Y') + 20; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <select name="due_date[month][]" class="due-date-month form-control custom-select">
                                            <option value="">Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="due_date[day][]" class="due-date-day form-control custom-select">
                                            <option value="">Day</option>
                                            @for ($day = 1; $day <= 32; $day++)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <div class="input-group">
                                    <span class="input-group-prepend" id="basic-addon1">
                                        <span class="input-group-text">Rp.</span>
                                    </span>
                                    <input name="debt_amount[]" class="debt-amount form-control multi-input-focus-target" placeholder="nominal tagih" aria-label="Username" aria-describedby="basic-addon1" type="text">
                                </div>
                            </div>
                        </div>
                    @endcomponent
                    <div class="alert alert-warning" role="alert">
                        Tersisa Rp.80.000 belum teralokasikan
                    </div>
                    <div class="clearfix">
                        <div class="right">
                            <button class="btn btn-primary">Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);


    require(['input-mask']);

    require(['jquery', 'moment'], function($, moment) {
        $(document).ready(function(){
            // disable all until user fill in all termin setting
            $('#termin-dates :input').prop('disabled', true);

            $('#selesai-btn').click(function(){
                // now user can interact with form
                $('#termin-dates :input').attr('disabled', false);

                let first_due_date_field = $('#termin-setting #first-due-date');
                let first_due_date = new Date(first_due_date_field.val());

                // set first row of termin dates to first due date
                // for .due-date-month, option value is 1-indexed not like first_due_date format that 0-indexed so we add by 1
                $($('.due-date-day')[0]).val(first_due_date.getDate());
                $($('.due-date-month')[0]).val(first_due_date.getMonth() + 1);
                $($('.due-date-year')[0]).val(first_due_date.getFullYear());

                $($('.debt-amount')[0]).focus();

                // disable first row of termin date input
                let periodic_type_field = $('.periodic-type:checked');
                if (periodic_type_field.val() == 'bulanan') disableFirstRowTerminDateInput(['month', 'year'])
                if (periodic_type_field.val() == 'tahunan') disableFirstRowTerminDateInput(['year'])
            });

            // selesai button will enabled if all termin settings have been fill in
            $('#termin-setting :input').change(function(){
                let periodic_type_field = $('#termin-setting .periodic-type:checked').val();
                let first_due_date_field = $('#termin-setting #first-due-date').val();
                let total_termin_amount_field = $('#termin-setting #total-termin-amount').val();

                if (periodic_type_field && first_due_date_field && total_termin_amount_field.trim()) {
                    $('#selesai-btn').attr('disabled', false);
                }
            });

            // fill in the total termin amount <input> with project price
            $('#total-termin-amount-btn').click(function(){
                let price = $(this).data('price');
                $('#total-termin-amount').val(price);
                $('#total-termin-amount').trigger('change');
            });

            // Why not click event? because last field not updated
            $('.multi-input-control').blur(function(){
                let periodic_type_field = $('.periodic-type:checked');

                if (periodic_type_field.val() == 'bulanan') updateTerminDate('month');
                if (periodic_type_field.val() == 'tahunan') updateTerminDate('year');
            });

            /**
             * Disable first row of termin date input.
             * Triggered only when selesai button clicked.
             *
             * @param which_field = day|month|year
             */
            function disableFirstRowTerminDateInput(which_field) {
                which_field.map(function(field){
                    $($('.due-date-'+field)[0]).attr('disabled', true);
                });
            }

            /**
             * update all termin date
             *
             * @param periodic_type = month|year
             */
            function updateTerminDate(periodic_type) {
                let first_due_date_field = $('#termin-setting #first-due-date');
                let first_due_date = new Date(first_due_date_field.val());

                console.log('first_due_date = ', dateToArray(first_due_date));
                let previous_due_date = first_due_date;

                // we don't want to increment first row
                $('#termin-dates .row-termin-date').not(':eq(0)').each(function() {
                    let current_due_date = previous_due_date;

                    let increment_date = moment(dateToArray(previous_due_date)).add(1 , periodic_type+'s');
                    current_due_date.setMonth(increment_date.month());
                    current_due_date.setFullYear(increment_date.year());

                    // apply due date to current row <select name="due-date-year">, <select name="due-date-month"> ... and day
                    setDateOfOneRowOfTerminDate(this, current_due_date);

                    previous_due_date = current_due_date;
                });
            }

            /**
             * @param row is DOM element
             */
            function setDateOfOneRowOfTerminDate(row, due_date) {
                // moment.js is 0-indexed month, compatible with Date() javascript
                // but in my <option> value is 1-indexed. Hence, I add +1 to getMonth()
                $(row).find('select.due-date-year').val(due_date.getFullYear());
                $(row).find('select.due-date-month').val(due_date.getMonth() + 1);
                $(row).find('select.due-date-day').val(due_date.getDate());
                console.log(dateToArray(due_date));
            }

            /**
             * convert Date instance to array that accepted by Moment.js library
             * that is, [Year, Month, Day]
             *
             * @param @date_var Date instance
             */
            function dateToArray(date_var) {
                return [
                    date_var.getFullYear(),
                    date_var.getMonth(),
                    date_var.getDate(),
                ];
            }
            console.log('test = ', moment([2018, 11, 1]).add(1, 'months').year());
        });
    });
</script>
@endsection
