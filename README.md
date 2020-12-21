<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Laravel Payment POC

This is a simple web application for proof of concept. 


- REST and JSON-RPC is simple and works together.
- STRIPE payment integration.
- Simple PDF Invoice generation. (Currently the invoice data is NOT saved as should be).
- The Invoice is generated from the Order.
- If the order contains Payment reference ID Invoice with number is generated.
- If the order NOT contains Payment reference ID Proforma Invoice is generated.

## UI/GUI

Demo site: https://payment.code4.digital/

Code repository: https://github.com/nzolt/payment

This is just a DEMO, so no real purchase, payment or invoice are made.
Register: any valid format e-mail address is accepted. 
We don't check the validity, not need to be real e-mail address.
We don't use the provided e-mail addresses for anything, except login.
All data will be deleted, without any backup every 1-2 weeks.

### Usage
Register with an e-mail address and password of your choice.
Go to shop and add any products to your cart.
You can empty your cart if you want and start over adding the products.
In the cart, you can go to "Checkout" and select the Payment method you want to use.

#### CARD (Stripe integration):
Name: any
Card number: choose your card from the fallowing test cards.
- 4242424242424242 Visa
- 4012888888881881 Visa
- 4000056655665556 Visa (debit)
- 5555555555554444 MasterCard
- 5200828282828210 MasterCard (debit)

Expire Month: any 2 digit month number (05)
Expire Year: any 4 digit year in the future (2021)
CVC code: any 3 digit number (252)

After the payment made, the generated invoice can be downloaded in PDF format.
The Invoice has unique Invoice number.

#### Bank transfer 

After choosing this payment method, the invoice also can be downloaded in PDF format.
The Invoice doesn't have unique Invoice number, instead has "Proforma Invoice" written on Invoice number field.

### REST and RPC API 

API is a web application provides CRUD operations to get JSON formated data.

- All endpoint expects valid API-KEY token in the header.
  Valid test API keys:
- Both for REST and JSON-RPC requests.
    - 0c54b224-094c-4196-badd-1766982cb74b
    - 3146ca98-9364-4e40-a59b-3d8153feef24
- REST only:
    - b5eb7312-aca4-4b36-a827-bfb759da6fe7
    - cfc5b3a8-aec2-4b47-96b3-9ce78c9a768d
- JSON-RPC only:
    - 772cbf4e-b496-4b41-b9a7-c453dda6ab55
    - e4181d14-ea74-4f58-9ae5-3cdc70ab9c0d

#### REST

Endpoints: [prefixed by /api]
- All Requests are sent to: https://payment.code4.digital/api
- Available functions:
    - Documentation coming soon...

#### JSON-API

Endpoints: [prefixed by /prc]
- All Requests are sent to: https://payment.code4.digital/rpc
- Accepts only POST requests.
- Available functions:
    - Documentation coming soon.

- JSON-RPC Envelope:
- {
  "jsonrpc": "2.0",
  "method": "methodName",
  "id": "uniqIdOfTheRequest",
  "params": {
  "key":"value"
  }
  }

TODO:
- Add Unit and Integration (Behat) tests.
- Add more error handling.
