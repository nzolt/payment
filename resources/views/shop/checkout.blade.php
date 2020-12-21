@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Checkout') }}</div>

                    <div class="card-body">
                        <div class="container">
                            <h2>Select paymentethod</h2>
                            <div class="flex-column float-right bold">Total: £{{ $total }} (GBP)</div>
                            <ul class="nav nav-tabs">
                                <li><a data-toggle="tab" href="#card">Card</a></li>
                                <li><a data-toggle="tab" href="#transfer">Transfer</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="card" class="tab-pane fade in active">
                                    <form novalidate="" method="post">
                                        @csrf
                                        <input type="hidden" name="type" value="card">
                                        <div class="App-Global-Fields App-Global-Fields flex-container spacing-16 direction-row wrap-wrap">
                                            <div class="flex-item width-12"><h2
                                                    class="PaymentMethod-Heading Text Text-color--gray600 Text-fontSize--16 Text-fontWeight--500">
                                                    Payment method card</h2></div>
                                        </div>
                                        <div class="Tabs is-desktop">
                                            <div class="Tabs-TabPanelContainer">
                                                <div style="opacity: 1; width: 100%; transform: none;">
                                                    <div id="card-tab-panel" role="tabpanel" aria-labelledby="card-tab">
                                                        <div class="flex-container spacing-16 direction-row wrap-wrap">
                                                            <div class="flex-item width-12">
                                                                <div class="FormFieldGroup">
                                                                    <div
                                                                        class="FormFieldGroup-labelContainer FormFieldGroup-labelContainer flex-container justify-content-space-between">
                                                                        <label for="cardNumber-fieldset"><span
                                                                                class="Text Text-color--gray600 Text-fontSize--13 Text-fontWeight--500">Card information</span></label>
                                                                    </div>
                                                                    <fieldset class="FormFieldGroup-Fieldset"
                                                                              id="cardNumber-fieldset">
                                                                        <div class="FormFieldGroup-container"
                                                                             id="cardNumber-fieldset">
                                                                            <div
                                                                                class="FormFieldGroup-child FormFieldGroup-child--width-12 FormFieldGroup-childLeft FormFieldGroup-childRight FormFieldGroup-childTop">
                                                                                <div class="FormFieldInput"><span
                                                                                        class="InputContainer"
                                                                                        data-max=""><input
                                                                                            class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                                            autocomplete="name"
                                                                                            autocorrect="off"
                                                                                            spellcheck="false"
                                                                                            id="cc-name"
                                                                                            name="cc-name"
                                                                                            inputmode="numeric"
                                                                                            aria-label="Name on card"
                                                                                            placeholder="Name on card"
                                                                                            aria-invalid="false"
                                                                                            value=""></span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="FormFieldGroup-child FormFieldGroup-child--width-12 FormFieldGroup-childLeft FormFieldGroup-childRight FormFieldGroup-childTop">
                                                                                <div class="FormFieldInput"><span
                                                                                        class="InputContainer"
                                                                                        data-max=""><input
                                                                                            class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                                            autocomplete="cc-number"
                                                                                            autocorrect="off"
                                                                                            spellcheck="false"
                                                                                            id="cardNumber"
                                                                                            name="cardNumber"
                                                                                            inputmode="numeric"
                                                                                            aria-label="Card number"
                                                                                            placeholder="1234 1234 1234 1234"
                                                                                            aria-invalid="false"
                                                                                            value=""></span>
                                                                                    <div class="FormFieldInput-Icons"
                                                                                         style="opacity: 1;">
                                                                                        <div
                                                                                            style="transform: none;"><span
                                                                                                class="FormFieldInput-IconsIcon is-visible"><img
                                                                                                    src="https://js.stripe.com/v3/fingerprinted/img/visa-365725566f9578a9589553aa9296d178.svg"
                                                                                                    alt="visa"
                                                                                                    class="BrandIcon"></span>
                                                                                        </div>
                                                                                        <div
                                                                                            style="transform: none;"><span
                                                                                                class="FormFieldInput-IconsIcon is-visible"><img
                                                                                                    src="https://js.stripe.com/v3/fingerprinted/img/mastercard-4d8844094130711885b5e41b28c9848f.svg"
                                                                                                    alt="mastercard"
                                                                                                    class="BrandIcon"></span>
                                                                                        </div>
                                                                                        <div
                                                                                            style="transform: none;"><span
                                                                                                class="FormFieldInput-IconsIcon is-visible"><img
                                                                                                    src="https://js.stripe.com/v3/fingerprinted/img/amex-a49b82f46c5cd6a96a6e418a6ca1717c.svg"
                                                                                                    alt="amex"
                                                                                                    class="BrandIcon"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="FormFieldGroup-child FormFieldGroup-child--width-6 FormFieldGroup-childLeft FormFieldGroup-childBottom">
                                                                                <div class="FormFieldInput"><span
                                                                                        class="InputContainer"
                                                                                        data-max=""><input
                                                                                            style="float: left; width: 50%"
                                                                                            class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                                            autocomplete="cc-exp-month"
                                                                                            autocorrect="off"
                                                                                            spellcheck="false"
                                                                                            id="cardExpiryMonth"
                                                                                            name="cardExpiryMonth"
                                                                                            inputmode="numeric"
                                                                                            aria-label="Expiration"
                                                                                            placeholder="MM"
                                                                                            aria-invalid="false"
                                                                                            value=""></span>
                                                                                </div>
                                                                                <div class="FormFieldInput"><span
                                                                                        class="InputContainer"
                                                                                        data-max=""><input
                                                                                            style="float: right; width: 50%"
                                                                                            class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                                            autocomplete="cc-exp-year"
                                                                                            autocorrect="off"
                                                                                            spellcheck="false"
                                                                                            id="cardExpiryYear"
                                                                                            name="cardExpiryYear"
                                                                                            inputmode="numeric"
                                                                                            aria-label="Expiration"
                                                                                            placeholder="YY"
                                                                                            aria-invalid="false"
                                                                                            value=""></span>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="FormFieldGroup-child FormFieldGroup-child--width-6 FormFieldGroup-childRight FormFieldGroup-childBottom">
                                                                                <div
                                                                                    class="FormFieldInput has-icon"><span
                                                                                        class="InputContainer"
                                                                                        data-max=""><input
                                                                                            class="CheckoutInput CheckoutInput--tabularnums Input Input--empty"
                                                                                            autocomplete="cc-csc"
                                                                                            autocorrect="off"
                                                                                            spellcheck="false"
                                                                                            id="cardCvc"
                                                                                            name="cardCvc"
                                                                                            inputmode="numeric"
                                                                                            aria-label="CVC"
                                                                                            placeholder="CVC"
                                                                                            aria-invalid="false"
                                                                                            value=""></span>
                                                                            <div style="opacity: 0; height: 0px;"><span
                                                                                    class="FieldError Text Text-color--red Text-fontSize--13"><span></span></span>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <div class="flex-item width-12"></div>
                                                            <div class="flex-item width-12">
                                                                <button class="SubmitButton SubmitButton--incomplete"
                                                                        type="submit"
                                                                        style="background-color: rgb(237, 95, 116); color: rgb(255, 255, 255);">
                                                                    <div class="SubmitButton-Shimmer"
                                                                         style="background: linear-gradient(to right, rgba(237, 95, 116, 0) 0%, rgb(255, 120, 139) 50%, rgba(237, 95, 116, 0) 100%);"></div>
                                                                    <div class="SubmitButton-TextContainer"><span
                                                                            class="SubmitButton-Text SubmitButton-Text--current Text Text-color--default Text-fontWeight--500 Text--truncate">Pay {{ config('settings.currency_symbol').number_format($total, 2) }}</span><span
                                                                            class="SubmitButton-Text SubmitButton-Text--pre Text Text-color--default Text-fontWeight--500 Text--truncate">Processing...</span>
                                                                    </div>

                                                                </button>
                                                                <div class="ConfirmPayment-PostSubmit"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="transfer" class="tab-pane fade">
                                    <form novalidate="" method="post">
                                        @csrf
                                        <input type="hidden" name="type" value="transfer">
                                        <div class="App-Global-Fields App-Global-Fields flex-container spacing-16 direction-row wrap-wrap">
                                            <div class="flex-item width-12"><h2
                                                    class="PaymentMethod-Heading Text Text-color--gray600 Text-fontSize--16 Text-fontWeight--500">
                                                    Payment method bank transfer</h2></div>
                                        </div>
                                        <div class="Tabs is-desktop">
                                            <div class="Tabs-TabPanelContainer">
                                                <div style="opacity: 1; width: 100%; transform: none;">
                                                    <div id="card-tab-panel" role="tabpanel" aria-labelledby="card-tab">
                                                        <div class="flex-container spacing-16 direction-row wrap-wrap">
                                                            <div class="flex-item width-12">
                                                                Bank informations:
                                                                <div class="FormFieldGroup-child FormFieldGroup-child--width-12 FormFieldGroup-childLeft FormFieldGroup-childBottom">
                                                                    <div class="FormFieldInput">
                                                                        <span data-max="" class="InputContainer">
                                                                            Account holder name: Acme 2020 Ltd.
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="FormFieldGroup-child FormFieldGroup-child--width-6 FormFieldGroup-childLeft FormFieldGroup-childBottom">
                                                                    <div class="FormFieldInput">
                                                                        <span data-max="" class="InputContainer">
                                                                            Sort code: 20-20-11
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="FormFieldGroup-child FormFieldGroup-child--width-6 FormFieldGroup-childLeft FormFieldGroup-childBottom">
                                                                    <div class="FormFieldInput">
                                                                        <span data-max="" class="InputContainer">
                                                                            Account nr.: 18 56 24 78
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-item width-12">
                                                                <button class="SubmitButton SubmitButton--incomplete"
                                                                        type="submit"
                                                                        style="background-color: rgb(237, 95, 116); color: rgb(255, 255, 255);">
                                                                    <div class="SubmitButton-Shimmer"
                                                                         style="background: linear-gradient(to right, rgba(237, 95, 116, 0) 0%, rgb(255, 120, 139) 50%, rgba(237, 95, 116, 0) 100%);"></div>
                                                                    <div class="SubmitButton-TextContainer"><span
                                                                            class="SubmitButton-Text SubmitButton-Text--current Text Text-color--default Text-fontWeight--500 Text--truncate">Pay {{ config('settings.currency_symbol').number_format($total, 2) }}</span><span
                                                                            class="SubmitButton-Text SubmitButton-Text--pre Text Text-color--default Text-fontWeight--500 Text--truncate">Processing...</span>
                                                                    </div>

                                                                </button>
                                                                <div class="ConfirmPayment-PostSubmit"></div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="https://js.stripe.com/v3/fingerprinted/css/checkout-ef01df36fabecc3e04d0464200acd827.css" rel="stylesheet">
    <link href="https://js.stripe.com/v3/fingerprinted/css/brand-icon-dad9f2899392469aa7005d168a96dfba.css" rel="stylesheet" type="text/css" >
    <link href="https://js.stripe.com/v3/fingerprinted/css/checkout-app-init-08e8df443f9e67fcbb7db4a7061ae2b1.css" rel="stylesheet" type="text/css">
@endpush



