# Laravel Test task

> After pushing Laravel to your repository, do a commit in any other branch and PR to the main one.

Task: connect 2 payment gateways (accept payments).

1. The database must contain tables of users and payments
2. Both gateways send data to `callback url` when the payment state changes.
3. Both gateways work with only one currency and transfer amounts in cents.
4. Creation of payment on the side of the gateway is not required (only the processing of state changes needs to be
   done).
5. For each payment gateway, it is necessary to implement the ability to set a limit, after which the payment processing
   stops until the next day.

## Gateway #1

### Merchant data:

```
merchant_id=6
merchant_key=KaTf5tZYHx4v7pgZ
```

### Fields sent to `callback_url` in `application/json` format:

| Field       | Type    | Description                                                           |
|-------------|---------|-----------------------------------------------------------------------|
| merchant_id | Integer | ID of merchant                                                        |
| payment_id  | Integer | Merchant's payment ID                                                 |
| status      | String  | Payment status. Could be new, pending, completed, expired or rejected |
| amount      | Integer | Payment amount                                                        |
| amount_paid | Integer | Actually paid amount (in merchant's currency)                         |
| timestamp   | Integer | Current timestamp                                                     |
| sign        | String  | Signature                                                             |

### Signature generation rules:

1. Sort parameters alphabetically.
2. Concatenate them (`excluding sign`) using the delimiter `:`.
3. Add `merchant_key` to the end of the resulting line.
4. Get SHA256 hash from it.

### Request example:

```json
{
    "merchant_id": 6,
    "payment_id": 13,
    "status": "completed",
    "amount": 500,
    "amount_paid": 500,
    "timestamp": 1654103837,
    "sign": "f027612e0e6cb321ca161de060237eeb97e46000da39d3add08d09074f931728"
}
```

<br><br><br>

## Gateway #2

### Merchant data:

```
app_id=816
app_key=rTaasVHeteGbhwBx
```

### Fields sent to `callback_url` in `multipart/form-data` format:

| Field       | Type    | Description                                                             |
|-------------|---------|-------------------------------------------------------------------------|
| project     | Integer | ID of merchant                                                          |
| invoice     | Integer | Merchant's payment ID                                                   |
| status      | String  | Payment status. Could be created, inprogress, paid, expired or rejected |
| amount      | Integer | Payment amount                                                          |
| amount_paid | Integer | Actually paid amount (in merchant's currency)                           |
| rand        | String  | Random string                                                           |

The request sends the `Authorization` header containing the signature.

### Signature generation rules:

1. Sort parameters alphabetically.
2. Merge fields using `.` delimiter.
3. Add `app_key` to the end of the resulting line.
4. Get MD5 hash from it.

### Request example:

#### Header

```
Authorization: d84eb9036bfc2fa7f46727f101c73c73
```

#### Body

```json
{
    "project": 816,
    "invoice": 73,
    "status": "completed",
    "amount": 700,
    "amount_paid": 700,
    "rand": "SNuHufEJ"
}
```
