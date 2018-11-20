@extends('template.master')
@section('title', 'Tambah Proyek: Form Utama')

@section('css')
<style>

.separator-left {
    border-left: 1px solid #ddd;
}

/* NOTE: maybe this css selector suitable only for this page */
.container--anticipate-long-text {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.container--anticipate-long-text:hover {
    overflow: visible;
    position: relative;
    z-index: 9;
    background-color: white;
}
span.content--anticipate-long-text:hover {
    background-color: white;
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

<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Termin Pembayaran
        </h1>
    </div>

    <div class="row row-cards">
        <div class="col-4">
            <!-- this form only for reset by jQUery -->
            <form id="termin-setting" onsubmit="return false">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Pengaturan Termin
                        </h3>
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
                                    @include('includes.form-element.input-money', [
                                        'id' => 'total-termin-amount',
                                        'name' => 'total_termin_amount',
                                        'class' => 'form-control',
                                        'placeholder' => '',
                                    ])
                                </div>
                                <span class="col-auto">
                                    <button id="total-termin-amount-btn" data-price="{{ $project->price }}" class="btn btn-secondary" type="button"><small>Gunakan Harga Proyek</small></button>
                                </span>
                            </div>
                        </div>
                        <p><small>*) Reload laman bila ingin mereset form ini</small></p>
                        <button id="selesai-btn" class="btn btn-primary" disabled>Selesai</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-8">
            <form id="termin-form" method="POST" action="{{ route('store-termin', ['project_id' => $project->id]) }}">
                <div class="row">
                    <div class="col-12">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="hidden" name="periodic_type" id="periodic-type-hidden" value="">

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
                                                    <select name="termin_detail[due_date][year][]" class="due-date-year form-control custom-select">
                                                        <option value="">Year</option>
                                                        @for ($year = date('Y'); $year <= date('Y') + 20; $year++)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-5">
                                                    <select name="termin_detail[due_date][month][]" class="due-date-month form-control custom-select">
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
                                                    <select name="termin_detail[due_date][day][]" class="due-date-day form-control custom-select">
                                                        <option value="">Day</option>
                                                        @for ($day = 1; $day <= 32; $day++)
                                                        <option value="{{ $day }}">{{ $day }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            @include('includes.form-element.input-money', [
                                                'name' => 'termin_detail[debt_amount][]',
                                                'class' => 'debt-amount form-control multi-input-focus-target',
                                                'placeholder' => 'nominal tagih',
                                            ])
                                        </div>
                                    </div>
                                @endcomponent
                                <div id="remaining-debt-amount" class="alert alert-warning" role="alert">
                                    <!-- message here -->
                                </div>
                                <div class="clearfix">
                                    <div class="right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="confirmation-card" class="card ">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Konfirmasi
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 pr-6">

                                        <fieldset class="form-fieldset">
                                            <!-- create table with row and col class -->
                                            <div class="row">
                                                <div class="col-3">Proyek</div>
                                                <div class="col-1">:</div>
                                                <div class="col-8">
                                                    <div class="container--anticipate-long-text">
                                                        <span class="content--anticipate-long-text">
                                                            <a href="{{ route('project-detail', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">Client</div>
                                                <div class="col-1">:</div>
                                                <!-- TODO: link to client detail -->
                                                <div class="col-8">
                                                    <div class="container--anticipate-long-text">
                                                        <span class="content--anticipate-long-text">
                                                            {{ $project->client->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                    </div>
                                    <div class="col-6 pl-6 separator-left">

                                        <div>
                                            <p>Ketik <code>Termin</code> di bawah</p>
                                            <input id="validation" class="form-control" type="text" name="validation" placeholder="ketik disini..." autocomplete="off">
                                        </div>

                                        <div class="alert alert-warning p-4 mt-5">
                                            <small class="status-animated">
                                                <i class="fa fa-warning mr-2"></i>
                                                Tindakan ini tidak bisa di-undo
                                            </small>
                                        </div>

                                        <div class="d-flex">
                                            <a href="" class="btn btn-link">Batal</a>
                                            {{-- Create termin is only when activating project.
                                                Activating means change project status from
                                                'draft' to 'onprogress' --}}
                                            <button id="primary-button" class="btn btn-primary ml-auto disabled">Ya, Termin dan Aktifkan Proyek</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    require(['input-mask']);

    require(['jquery', 'moment', 'global_functions'], ($, moment, g) => {

        $(document).ready(function(){
            // prevent Firefox to keep user input even after reloaded
            $('form').trigger('reset');

            // disable until all termin setting adjusted
            $('#selesai-btn').attr('disabled', true);

            // disable all until user fill in all termin setting
            $('#termin-dates :input').attr('disabled', true);

            $('#selesai-btn').click(function(){
                $('#termin-setting :input').attr('disabled', true);

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

                $('#periodic-type-hidden').val(periodic_type_field.val())
            });

            // selesai button will enabled if all termin settings have been fill in
            $('#termin-setting :input').change(function(){
                let periodic_type_field = $('#termin-setting .periodic-type:checked').val();
                let first_due_date_field = $('#termin-setting #first-due-date').val();
                let total_termin_amount_field = $('#termin-setting #total-termin-amount').val();

                $('#periodic-type-hidden').val(periodic_type_field);

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

            $('#termin-form').submit(function() {
                $('.debt-amount').each(function(){
                    $(this).val($(this).cleanVal());
                });
                $('#termin-form :input').prop('disabled', false);
            });

            /**
             * update all termin date
             *
             * @param periodic_type = month|year
             */
            function updateTerminDate(periodic_type) {
                let first_due_date_field = $('#termin-setting #first-due-date');
                let first_due_date = new Date(first_due_date_field.val());

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

            $('#termin-dates').on('keyup', '.debt-amount', function(){
                let total_amount = 0;
                $('.debt-amount').each(function() {
                    let amount = g.cleanValMask( $(this).val() );
                    total_amount += amount;
                });

                let total_termin_amount = g.cleanValMask( $('#total-termin-amount').val() );
                // TODO: check why I wrote this?
                total_termin_amount = total_termin_amount;

                console.log(total_termin_amount);

                let remaining_amount = total_termin_amount - total_amount;

                if (remaining_amount < 0) {
                    $('#remaining-debt-amount').text('Nilai melebihi total biaya termin');
                    $('#confirmation-card :input').attr('disabled', true);
                }
                if (remaining_amount > 0) {
                    $('#remaining-debt-amount').text('Tersisa Rp.'+remaining_amount+' belum teralokasikan');
                    $('#confirmation-card :input').attr('disabled', true);
                }
                if (remaining_amount === 0) {
                    $('#remaining-debt-amount').text('OK...');
                    $('#confirmation-card :input').attr('disabled', false);
                }
            });
        });

        // Dynamic element this code for input mask
        // I still don't know why I keed jQuery on() because without it, fails
        $('#termin-dates').on('click', '.multi-input-control', function(){
            $('#termin-dates .debt-amount').mask('000.000.000.000.000', {'reverse': true});
        });
    });
</script>

<script>
require(['jquery'], function($){
    $(document).ready(function(){
        // disable all until user fill in all termin setting
        $('#confirmation-card :input').attr('disabled', true);

        $('input#validation').keyup(function(){
            let val = $(this).val();
            if (val == 'Termin') {
                $('#primary-button').removeClass('disabled');
            } else {
                $('#primary-button').addClass('disabled');
            }
        });
    });
});
</script>
@endsection
