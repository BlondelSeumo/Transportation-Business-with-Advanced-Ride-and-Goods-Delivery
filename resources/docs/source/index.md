---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#Authentication


APIs for Authentication
<!-- START_ece446bb010331e4f3e1d3037655e23c -->
## Social auth

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/social-auth/1" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"device_token":"quia","login_by":"voluptas","oauth_token":"qui"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/social-auth/1"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "device_token": "quia",
    "login_by": "voluptas",
    "oauth_token": "qui"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwiacaP8zkCWTpzh8ZtWBUYVrPkYRWbwz-L5x6dx2d901Aq_7-LwlzPMtP0N93kVfFuLwK2RCzlVtcCTxZaUW9S7x3Y",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf7879992509667dd68eacc488bddb2cc005357cdab1da5f0582659eef11e06bf2447c1209f6c17c83453cd6fa6dd6d5d98ff7129a6d3f3509c6c99fba379ea4aee85c0eb89b5f648682484452219d1c592d80c3165657a519f790ba19ad347774c0a199"
}
```

### HTTP Request
`POST api/v1/social-auth/{provider}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `device_token` | string |  optional  | optional fcm_token for push notification
        `login_by` | string |  required  | i.e android,ios
        `oauth_token` | string |  required  | from social provider
    
<!-- END_ece446bb010331e4f3e1d3037655e23c -->

#Cancellation Management


APIs for User & cancellations
<!-- START_0c100dd8d12c1d99e10246062b86b8e6 -->
## List Cancellation Reasons

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/common/cancallation/reasons" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/cancallation/reasons"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "cancellation_reasons_listed",
    "data": [
        {
            "id": "e5cf4a77-93ee-48fd-b889-6dcf4b7041e3",
            "user_type": "user",
            "payment_type": "free",
            "arrival_status": "before",
            "reason": "test-reason",
            "active": 1,
            "created_at": "2020-08-31 18:13:18",
            "updated_at": "2020-08-31 18:13:18",
            "deleted_at": null
        }
    ]
}
```

### HTTP Request
`GET api/v1/common/cancallation/reasons`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `arrived` |  required  | arrived status of the trip request. the value must be after/before

<!-- END_0c100dd8d12c1d99e10246062b86b8e6 -->

#Complaints apis


APIs for Complaints
<!-- START_050b654106852ab7c681599fcc893c36 -->
## List complaint titles

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/common/complaint-titles?request_id=nihil" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/complaint-titles"
);

let params = {
    "request_id": "nihil",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "complaint_titles_listed",
    "data": [
        {
            "id": "e5cf4a77-93ee-48fd-b889-6dcf4b7041e3",
            "user_type": "user",
            "title": "test-title",
            "complaint_type": "general",
            "active": 1,
            "created_at": "2020-08-31 18:13:18",
            "updated_at": "2020-08-31 18:13:18",
            "deleted_at": null
        }
    ]
}
```

### HTTP Request
`GET api/v1/common/complaint-titles`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `request_id` |  optional  | uuid optional request id for complaint against the request

<!-- END_050b654106852ab7c681599fcc893c36 -->

<!-- START_291b55c0d3a934ff82875c22536b8998 -->
## Make Complaints

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/common/make-complaint" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"complaint_title_id":3,"description":"soluta","request_id":"commodi"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/make-complaint"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "complaint_title_id": 3,
    "description": "soluta",
    "request_id": "commodi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST api/v1/common/make-complaint`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `complaint_title_id` | integer |  required  | id of complaint titles
        `description` | string |  required  | description of complaints
        `request_id` | uuid |  optional  | optional request id for complaint against the request
    
<!-- END_291b55c0d3a934ff82875c22536b8998 -->

#Countries


Get countries
<!-- START_7a483081849344aa9cc1a1ce81ed9c3f -->
## Get all the countries.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/countries" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/countries"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "dial_code": "+93",
            "name": "Afghanistan",
            "code": "AF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AF.png",
            "active": true
        },
        {
            "id": 74,
            "dial_code": "+358",
            "name": "Åland Islands",
            "code": "AX",
            "flag": null,
            "active": true
        },
        {
            "id": 2,
            "dial_code": "+355",
            "name": "Albania",
            "code": "AL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AL.png",
            "active": true
        },
        {
            "id": 4,
            "dial_code": "+213",
            "name": "Algeria",
            "code": "DZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DZ.png",
            "active": true
        },
        {
            "id": 5,
            "dial_code": "+1",
            "name": "American Samoa",
            "code": "AS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AS.png",
            "active": true
        },
        {
            "id": 6,
            "dial_code": "+376",
            "name": "Andorra",
            "code": "AD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AD.png",
            "active": true
        },
        {
            "id": 7,
            "dial_code": "+244",
            "name": "Angola",
            "code": "AO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AO.png",
            "active": true
        },
        {
            "id": 190,
            "dial_code": "+1",
            "name": "Anguilla",
            "code": "AI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AI.png",
            "active": true
        },
        {
            "id": 3,
            "dial_code": "+672",
            "name": "Antarctica",
            "code": "AQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AQ.png",
            "active": true
        },
        {
            "id": 8,
            "dial_code": "+1",
            "name": "Antigua and Barbuda",
            "code": "AG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AG.png",
            "active": true
        },
        {
            "id": 10,
            "dial_code": "+54",
            "name": "Argentina",
            "code": "AR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AR.png",
            "active": true
        },
        {
            "id": 16,
            "dial_code": "+374",
            "name": "Armenia",
            "code": "AM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AM.png",
            "active": true
        },
        {
            "id": 153,
            "dial_code": "+297",
            "name": "Aruba",
            "code": "AW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AW.png",
            "active": true
        },
        {
            "id": 11,
            "dial_code": "+61",
            "name": "Australia",
            "code": "AU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AU.png",
            "active": true
        },
        {
            "id": 12,
            "dial_code": "+43",
            "name": "Austria",
            "code": "AT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AT.png",
            "active": true
        },
        {
            "id": 9,
            "dial_code": "+994",
            "name": "Azerbaijan",
            "code": "AZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AZ.png",
            "active": true
        },
        {
            "id": 13,
            "dial_code": "+1",
            "name": "Bahamas",
            "code": "BS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BS.png",
            "active": true
        },
        {
            "id": 14,
            "dial_code": "+973",
            "name": "Bahrain",
            "code": "BH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BH.png",
            "active": true
        },
        {
            "id": 15,
            "dial_code": "+880",
            "name": "Bangladesh",
            "code": "BD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BD.png",
            "active": true
        },
        {
            "id": 17,
            "dial_code": "+1",
            "name": "Barbados",
            "code": "BB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BB.png",
            "active": true
        },
        {
            "id": 34,
            "dial_code": "+375",
            "name": "Belarus",
            "code": "BY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BY.png",
            "active": true
        },
        {
            "id": 18,
            "dial_code": "+32",
            "name": "Belgium",
            "code": "BE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BE.png",
            "active": true
        },
        {
            "id": 26,
            "dial_code": "+501",
            "name": "Belize",
            "code": "BZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BZ.png",
            "active": true
        },
        {
            "id": 59,
            "dial_code": "+229",
            "name": "Benin",
            "code": "BJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BJ.png",
            "active": true
        },
        {
            "id": 19,
            "dial_code": "+1",
            "name": "Bermuda",
            "code": "BM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BM.png",
            "active": true
        },
        {
            "id": 20,
            "dial_code": "+975",
            "name": "Bhutan",
            "code": "BT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BT.png",
            "active": true
        },
        {
            "id": 21,
            "dial_code": "+591",
            "name": "Bolivia, Plurinational State of",
            "code": "BO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BO.png",
            "active": true
        },
        {
            "id": 155,
            "dial_code": "+599",
            "name": "Bonaire, Sint Eustatius and Saba",
            "code": "BQ",
            "flag": null,
            "active": true
        },
        {
            "id": 22,
            "dial_code": "+387",
            "name": "Bosnia and Herzegovina",
            "code": "BA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BA.png",
            "active": true
        },
        {
            "id": 23,
            "dial_code": "+267",
            "name": "Botswana",
            "code": "BW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BW.png",
            "active": true
        },
        {
            "id": 24,
            "dial_code": "+47",
            "name": "Bouvet Island",
            "code": "BV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BV.png",
            "active": true
        },
        {
            "id": 25,
            "dial_code": "+55",
            "name": "Brazil",
            "code": "BR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BR.png",
            "active": true
        },
        {
            "id": 27,
            "dial_code": "+246",
            "name": "British Indian Ocean Territory",
            "code": "IO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IO.png",
            "active": true
        },
        {
            "id": 30,
            "dial_code": "+673",
            "name": "Brunei Darussalam",
            "code": "BN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BN.png",
            "active": true
        },
        {
            "id": 31,
            "dial_code": "+359",
            "name": "Bulgaria",
            "code": "BG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BG.png",
            "active": true
        },
        {
            "id": 242,
            "dial_code": "+226",
            "name": "Burkina Faso",
            "code": "BF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BF.png",
            "active": true
        },
        {
            "id": 33,
            "dial_code": "+257",
            "name": "Burundi",
            "code": "BI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BI.png",
            "active": true
        },
        {
            "id": 35,
            "dial_code": "+855",
            "name": "Cambodia",
            "code": "KH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KH.png",
            "active": true
        },
        {
            "id": 36,
            "dial_code": "+237",
            "name": "Cameroon",
            "code": "CM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CM.png",
            "active": true
        },
        {
            "id": 37,
            "dial_code": "+1",
            "name": "Canada",
            "code": "CA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CA.png",
            "active": true
        },
        {
            "id": 38,
            "dial_code": "+238",
            "name": "Cape Verde",
            "code": "CV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CV.png",
            "active": true
        },
        {
            "id": 39,
            "dial_code": "+1",
            "name": "Cayman Islands",
            "code": "KY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KY.png",
            "active": true
        },
        {
            "id": 40,
            "dial_code": "+236",
            "name": "Central African Republic",
            "code": "CF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CF.png",
            "active": true
        },
        {
            "id": 42,
            "dial_code": "+235",
            "name": "Chad",
            "code": "TD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TD.png",
            "active": true
        },
        {
            "id": 43,
            "dial_code": "+56",
            "name": "Chile",
            "code": "CL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CL.png",
            "active": true
        },
        {
            "id": 44,
            "dial_code": "+86",
            "name": "China",
            "code": "CN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CN.png",
            "active": true
        },
        {
            "id": 46,
            "dial_code": "+61",
            "name": "Christmas Island",
            "code": "CX",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CX.png",
            "active": true
        },
        {
            "id": 47,
            "dial_code": "+61",
            "name": "Cocos (Keeling) Islands",
            "code": "CC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CC.png",
            "active": true
        },
        {
            "id": 48,
            "dial_code": "+57",
            "name": "Colombia",
            "code": "CO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CO.png",
            "active": true
        },
        {
            "id": 49,
            "dial_code": "+269",
            "name": "Comoros",
            "code": "KM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KM.png",
            "active": true
        },
        {
            "id": 51,
            "dial_code": "+242",
            "name": "Congo",
            "code": "CG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CG.png",
            "active": true
        },
        {
            "id": 52,
            "dial_code": "+243",
            "name": "Congo, the Democratic Republic of the",
            "code": "CD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CD.png",
            "active": true
        },
        {
            "id": 53,
            "dial_code": "+682",
            "name": "Cook Islands",
            "code": "CK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CK.png",
            "active": true
        },
        {
            "id": 54,
            "dial_code": "+506",
            "name": "Costa Rica",
            "code": "CR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CR.png",
            "active": true
        },
        {
            "id": 110,
            "dial_code": "+225",
            "name": "Côte d'Ivoire",
            "code": "CI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CI.png",
            "active": true
        },
        {
            "id": 55,
            "dial_code": "+385",
            "name": "Croatia",
            "code": "HR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HR.png",
            "active": true
        },
        {
            "id": 56,
            "dial_code": "+53",
            "name": "Cuba",
            "code": "CU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CU.png",
            "active": true
        },
        {
            "id": 152,
            "dial_code": "+599",
            "name": "Curaçao",
            "code": "CW",
            "flag": null,
            "active": true
        },
        {
            "id": 57,
            "dial_code": "+357",
            "name": "Cyprus",
            "code": "CY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CY.png",
            "active": true
        },
        {
            "id": 58,
            "dial_code": "+420",
            "name": "Czech Republic",
            "code": "CZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CZ.png",
            "active": true
        },
        {
            "id": 60,
            "dial_code": "+45",
            "name": "Denmark",
            "code": "DK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DK.png",
            "active": true
        },
        {
            "id": 79,
            "dial_code": "+253",
            "name": "Djibouti",
            "code": "DJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DJ.png",
            "active": true
        },
        {
            "id": 61,
            "dial_code": "+1",
            "name": "Dominica",
            "code": "DM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DM.png",
            "active": true
        },
        {
            "id": 62,
            "dial_code": "+1",
            "name": "Dominican Republic",
            "code": "DO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DO.png",
            "active": true
        },
        {
            "id": 63,
            "dial_code": "+593",
            "name": "Ecuador",
            "code": "EC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EC.png",
            "active": true
        },
        {
            "id": 234,
            "dial_code": "+20",
            "name": "Egypt",
            "code": "EG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EG.png",
            "active": true
        },
        {
            "id": 64,
            "dial_code": "+503",
            "name": "El Salvador",
            "code": "SV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SV.png",
            "active": true
        },
        {
            "id": 65,
            "dial_code": "+240",
            "name": "Equatorial Guinea",
            "code": "GQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GQ.png",
            "active": true
        },
        {
            "id": 67,
            "dial_code": "+291",
            "name": "Eritrea",
            "code": "ER",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ER.png",
            "active": true
        },
        {
            "id": 68,
            "dial_code": "+372",
            "name": "Estonia",
            "code": "EE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EE.png",
            "active": true
        },
        {
            "id": 66,
            "dial_code": "+251",
            "name": "Ethiopia",
            "code": "ET",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ET.png",
            "active": true
        },
        {
            "id": 70,
            "dial_code": "+500",
            "name": "Falkland Islands (Malvinas)",
            "code": "FK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FK.png",
            "active": true
        },
        {
            "id": 69,
            "dial_code": "+298",
            "name": "Faroe Islands",
            "code": "FO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FO.png",
            "active": true
        },
        {
            "id": 72,
            "dial_code": "+679",
            "name": "Fiji",
            "code": "FJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FJ.png",
            "active": true
        },
        {
            "id": 73,
            "dial_code": "+358",
            "name": "Finland",
            "code": "FI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FI.png",
            "active": true
        },
        {
            "id": 75,
            "dial_code": "+33",
            "name": "France",
            "code": "FR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FR.png",
            "active": true
        },
        {
            "id": 76,
            "dial_code": "+594",
            "name": "French Guiana",
            "code": "GF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GF.png",
            "active": true
        },
        {
            "id": 77,
            "dial_code": "+689",
            "name": "French Polynesia",
            "code": "PF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PF.png",
            "active": true
        },
        {
            "id": 78,
            "dial_code": "+33",
            "name": "French Southern Territories",
            "code": "TF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TF.png",
            "active": true
        },
        {
            "id": 80,
            "dial_code": "+241",
            "name": "Gabon",
            "code": "GA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GA.png",
            "active": true
        },
        {
            "id": 82,
            "dial_code": "+220",
            "name": "Gambia",
            "code": "GM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GM.png",
            "active": true
        },
        {
            "id": 81,
            "dial_code": "+995",
            "name": "Georgia",
            "code": "GE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GE.png",
            "active": true
        },
        {
            "id": 84,
            "dial_code": "+49",
            "name": "Germany",
            "code": "DE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DE.png",
            "active": true
        },
        {
            "id": 85,
            "dial_code": "+233",
            "name": "Ghana",
            "code": "GH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GH.png",
            "active": true
        },
        {
            "id": 86,
            "dial_code": "+350",
            "name": "Gibraltar",
            "code": "GI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GI.png",
            "active": true
        },
        {
            "id": 88,
            "dial_code": "+30",
            "name": "Greece",
            "code": "GR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GR.png",
            "active": true
        },
        {
            "id": 89,
            "dial_code": "+299",
            "name": "Greenland",
            "code": "GL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GL.png",
            "active": true
        },
        {
            "id": 90,
            "dial_code": "+1",
            "name": "Grenada",
            "code": "GD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GD.png",
            "active": true
        },
        {
            "id": 91,
            "dial_code": "+590",
            "name": "Guadeloupe",
            "code": "GP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GP.png",
            "active": true
        },
        {
            "id": 92,
            "dial_code": "+1",
            "name": "Guam",
            "code": "GU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GU.png",
            "active": true
        },
        {
            "id": 93,
            "dial_code": "+502",
            "name": "Guatemala",
            "code": "GT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GT.png",
            "active": true
        },
        {
            "id": 236,
            "dial_code": "+44",
            "name": "Guernsey",
            "code": "GG",
            "flag": null,
            "active": true
        },
        {
            "id": 94,
            "dial_code": "+224",
            "name": "Guinea",
            "code": "GN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GN.png",
            "active": true
        },
        {
            "id": 179,
            "dial_code": "+245",
            "name": "Guinea-Bissau",
            "code": "GW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GW.png",
            "active": true
        },
        {
            "id": 95,
            "dial_code": "+592",
            "name": "Guyana",
            "code": "GY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GY.png",
            "active": true
        },
        {
            "id": 96,
            "dial_code": "+509",
            "name": "Haiti",
            "code": "HT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HT.png",
            "active": true
        },
        {
            "id": 97,
            "dial_code": "+61",
            "name": "Heard Island and McDonald Islands",
            "code": "HM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HM.png",
            "active": true
        },
        {
            "id": 98,
            "dial_code": "+39",
            "name": "Holy See (Vatican City State)",
            "code": "VA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VA.png",
            "active": true
        },
        {
            "id": 99,
            "dial_code": "+504",
            "name": "Honduras",
            "code": "HN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HN.png",
            "active": true
        },
        {
            "id": 100,
            "dial_code": "+852",
            "name": "Hong Kong",
            "code": "HK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HK.png",
            "active": true
        },
        {
            "id": 101,
            "dial_code": "+36",
            "name": "Hungary",
            "code": "HU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HU.png",
            "active": true
        },
        {
            "id": 102,
            "dial_code": "+354",
            "name": "Iceland",
            "code": "IS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IS.png",
            "active": true
        },
        {
            "id": 103,
            "dial_code": "+91",
            "name": "India",
            "code": "IN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IN.png",
            "active": true
        },
        {
            "id": 104,
            "dial_code": "+62",
            "name": "Indonesia",
            "code": "ID",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ID.png",
            "active": true
        },
        {
            "id": 105,
            "dial_code": "+98",
            "name": "Iran, Islamic Republic of",
            "code": "IR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IR.png",
            "active": true
        },
        {
            "id": 106,
            "dial_code": "+964",
            "name": "Iraq",
            "code": "IQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IQ.png",
            "active": true
        },
        {
            "id": 107,
            "dial_code": "+353",
            "name": "Ireland",
            "code": "IE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IE.png",
            "active": true
        },
        {
            "id": 238,
            "dial_code": "+44",
            "name": "Isle of Man",
            "code": "IM",
            "flag": null,
            "active": true
        },
        {
            "id": 108,
            "dial_code": "+972",
            "name": "Israel",
            "code": "IL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IL.png",
            "active": true
        },
        {
            "id": 109,
            "dial_code": "+39",
            "name": "Italy",
            "code": "IT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IT.png",
            "active": true
        },
        {
            "id": 111,
            "dial_code": "+1",
            "name": "Jamaica",
            "code": "JM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/JM.png",
            "active": true
        },
        {
            "id": 112,
            "dial_code": "+81",
            "name": "Japan",
            "code": "JP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/JP.png",
            "active": true
        },
        {
            "id": 237,
            "dial_code": "+44",
            "name": "Jersey",
            "code": "JE",
            "flag": null,
            "active": true
        },
        {
            "id": 114,
            "dial_code": "+962",
            "name": "Jordan",
            "code": "JO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/JO.png",
            "active": true
        },
        {
            "id": 113,
            "dial_code": "+7",
            "name": "Kazakhstan",
            "code": "KZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KZ.png",
            "active": true
        },
        {
            "id": 115,
            "dial_code": "+254",
            "name": "Kenya",
            "code": "KE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KE.png",
            "active": true
        },
        {
            "id": 87,
            "dial_code": "+686",
            "name": "Kiribati",
            "code": "KI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KI.png",
            "active": true
        },
        {
            "id": 116,
            "dial_code": "+850",
            "name": "Korea, Democratic People's Republic of",
            "code": "KP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KP.png",
            "active": true
        },
        {
            "id": 117,
            "dial_code": "+82",
            "name": "Korea, Republic of",
            "code": "KR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KR.png",
            "active": true
        },
        {
            "id": 118,
            "dial_code": "+965",
            "name": "Kuwait",
            "code": "KW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KW.png",
            "active": true
        },
        {
            "id": 119,
            "dial_code": "+996",
            "name": "Kyrgyzstan",
            "code": "KG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KG.png",
            "active": true
        },
        {
            "id": 120,
            "dial_code": "+856",
            "name": "Lao People's Democratic Republic",
            "code": "LA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LA.png",
            "active": true
        },
        {
            "id": 123,
            "dial_code": "+371",
            "name": "Latvia",
            "code": "LV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LV.png",
            "active": true
        },
        {
            "id": 121,
            "dial_code": "+961",
            "name": "Lebanon",
            "code": "LB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LB.png",
            "active": true
        },
        {
            "id": 122,
            "dial_code": "+266",
            "name": "Lesotho",
            "code": "LS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LS.png",
            "active": true
        },
        {
            "id": 124,
            "dial_code": "+231",
            "name": "Liberia",
            "code": "LR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LR.png",
            "active": true
        },
        {
            "id": 125,
            "dial_code": "+218",
            "name": "Libya",
            "code": "LY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LY.png",
            "active": true
        },
        {
            "id": 126,
            "dial_code": "+423",
            "name": "Liechtenstein",
            "code": "LI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LI.png",
            "active": true
        },
        {
            "id": 127,
            "dial_code": "+370",
            "name": "Lithuania",
            "code": "LT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LT.png",
            "active": true
        },
        {
            "id": 128,
            "dial_code": "+352",
            "name": "Luxembourg",
            "code": "LU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LU.png",
            "active": true
        },
        {
            "id": 129,
            "dial_code": "+853",
            "name": "Macao",
            "code": "MO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MO.png",
            "active": true
        },
        {
            "id": 233,
            "dial_code": "+389",
            "name": "Macedonia, the former Yugoslav Republic of",
            "code": "MK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MK.png",
            "active": true
        },
        {
            "id": 130,
            "dial_code": "+261",
            "name": "Madagascar",
            "code": "MG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MG.png",
            "active": true
        },
        {
            "id": 131,
            "dial_code": "+265",
            "name": "Malawi",
            "code": "MW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MW.png",
            "active": true
        },
        {
            "id": 132,
            "dial_code": "+60",
            "name": "Malaysia",
            "code": "MY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MY.png",
            "active": true
        },
        {
            "id": 133,
            "dial_code": "+960",
            "name": "Maldives",
            "code": "MV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MV.png",
            "active": true
        },
        {
            "id": 134,
            "dial_code": "+223",
            "name": "Mali",
            "code": "ML",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ML.png",
            "active": true
        },
        {
            "id": 135,
            "dial_code": "+356",
            "name": "Malta",
            "code": "MT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MT.png",
            "active": true
        },
        {
            "id": 168,
            "dial_code": "+692",
            "name": "Marshall Islands",
            "code": "MH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MH.png",
            "active": true
        },
        {
            "id": 136,
            "dial_code": "+596",
            "name": "Martinique",
            "code": "MQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MQ.png",
            "active": true
        },
        {
            "id": 137,
            "dial_code": "+222",
            "name": "Mauritania",
            "code": "MR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MR.png",
            "active": true
        },
        {
            "id": 138,
            "dial_code": "+230",
            "name": "Mauritius",
            "code": "MU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MU.png",
            "active": true
        },
        {
            "id": 50,
            "dial_code": "+262",
            "name": "Mayotte",
            "code": "YT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/YT.png",
            "active": true
        },
        {
            "id": 139,
            "dial_code": "+52",
            "name": "Mexico",
            "code": "MX",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MX.png",
            "active": true
        },
        {
            "id": 167,
            "dial_code": "+691",
            "name": "Micronesia, Federated States of",
            "code": "FM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FM.png",
            "active": true
        },
        {
            "id": 142,
            "dial_code": "+373",
            "name": "Moldova, Republic of",
            "code": "MD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MD.png",
            "active": true
        },
        {
            "id": 140,
            "dial_code": "+377",
            "name": "Monaco",
            "code": "MC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MC.png",
            "active": true
        },
        {
            "id": 141,
            "dial_code": "+976",
            "name": "Mongolia",
            "code": "MN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MN.png",
            "active": true
        },
        {
            "id": 143,
            "dial_code": "+382",
            "name": "Montenegro",
            "code": "ME",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ME.png",
            "active": true
        },
        {
            "id": 144,
            "dial_code": "+1",
            "name": "Montserrat",
            "code": "MS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MS.png",
            "active": true
        },
        {
            "id": 145,
            "dial_code": "+212",
            "name": "Morocco",
            "code": "MA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MA.png",
            "active": true
        },
        {
            "id": 146,
            "dial_code": "+258",
            "name": "Mozambique",
            "code": "MZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MZ.png",
            "active": true
        },
        {
            "id": 32,
            "dial_code": "+95",
            "name": "Myanmar",
            "code": "MM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MM.png",
            "active": true
        },
        {
            "id": 148,
            "dial_code": "+264",
            "name": "Namibia",
            "code": "NA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NA.png",
            "active": true
        },
        {
            "id": 149,
            "dial_code": "+674",
            "name": "Nauru",
            "code": "NR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NR.png",
            "active": true
        },
        {
            "id": 150,
            "dial_code": "+977",
            "name": "Nepal",
            "code": "NP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NP.png",
            "active": true
        },
        {
            "id": 151,
            "dial_code": "+31",
            "name": "Netherlands",
            "code": "NL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NL.png",
            "active": true
        },
        {
            "id": 156,
            "dial_code": "+687",
            "name": "New Caledonia",
            "code": "NC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NC.png",
            "active": true
        },
        {
            "id": 158,
            "dial_code": "+64",
            "name": "New Zealand",
            "code": "NZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NZ.png",
            "active": true
        },
        {
            "id": 159,
            "dial_code": "+505",
            "name": "Nicaragua",
            "code": "NI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NI.png",
            "active": true
        },
        {
            "id": 160,
            "dial_code": "+227",
            "name": "Niger",
            "code": "NE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NE.png",
            "active": true
        },
        {
            "id": 161,
            "dial_code": "+234",
            "name": "Nigeria",
            "code": "NG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NG.png",
            "active": true
        },
        {
            "id": 162,
            "dial_code": "+683",
            "name": "Niue",
            "code": "NU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NU.png",
            "active": true
        },
        {
            "id": 163,
            "dial_code": "+672",
            "name": "Norfolk Island",
            "code": "NF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NF.png",
            "active": true
        },
        {
            "id": 165,
            "dial_code": "+1",
            "name": "Northern Mariana Islands",
            "code": "MP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MP.png",
            "active": true
        },
        {
            "id": 164,
            "dial_code": "+47",
            "name": "Norway",
            "code": "NO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NO.png",
            "active": true
        },
        {
            "id": 147,
            "dial_code": "+968",
            "name": "Oman",
            "code": "OM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/OM.png",
            "active": true
        },
        {
            "id": 170,
            "dial_code": "+92",
            "name": "Pakistan",
            "code": "PK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PK.png",
            "active": true
        },
        {
            "id": 169,
            "dial_code": "+680",
            "name": "Palau",
            "code": "PW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PW.png",
            "active": true
        },
        {
            "id": 83,
            "dial_code": "+970",
            "name": "Palestinian Territory, Occupied",
            "code": "PS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PS.png",
            "active": true
        },
        {
            "id": 171,
            "dial_code": "+507",
            "name": "Panama",
            "code": "PA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PA.png",
            "active": true
        },
        {
            "id": 172,
            "dial_code": "+675",
            "name": "Papua New Guinea",
            "code": "PG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PG.png",
            "active": true
        },
        {
            "id": 173,
            "dial_code": "+595",
            "name": "Paraguay",
            "code": "PY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PY.png",
            "active": true
        },
        {
            "id": 174,
            "dial_code": "+51",
            "name": "Peru",
            "code": "PE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PE.png",
            "active": true
        },
        {
            "id": 175,
            "dial_code": "+63",
            "name": "Philippines",
            "code": "PH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PH.png",
            "active": true
        },
        {
            "id": 176,
            "dial_code": "+649",
            "name": "Pitcairn",
            "code": "PN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PN.png",
            "active": true
        },
        {
            "id": 177,
            "dial_code": "+48",
            "name": "Poland",
            "code": "PL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PL.png",
            "active": true
        },
        {
            "id": 178,
            "dial_code": "+351",
            "name": "Portugal",
            "code": "PT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PT.png",
            "active": true
        },
        {
            "id": 181,
            "dial_code": "+1",
            "name": "Puerto Rico",
            "code": "PR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PR.png",
            "active": true
        },
        {
            "id": 182,
            "dial_code": "+974",
            "name": "Qatar",
            "code": "QA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/QA.png",
            "active": true
        },
        {
            "id": 183,
            "dial_code": "+262",
            "name": "Réunion",
            "code": "RE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RE.png",
            "active": true
        },
        {
            "id": 184,
            "dial_code": "+40",
            "name": "Romania",
            "code": "RO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RO.png",
            "active": true
        },
        {
            "id": 185,
            "dial_code": "+7",
            "name": "Russian Federation",
            "code": "RU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RU.png",
            "active": true
        },
        {
            "id": 186,
            "dial_code": "+250",
            "name": "Rwanda",
            "code": "RW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RW.png",
            "active": true
        },
        {
            "id": 187,
            "dial_code": "+590",
            "name": "Saint Barthélemy",
            "code": "BL",
            "flag": null,
            "active": true
        },
        {
            "id": 188,
            "dial_code": "+290",
            "name": "Saint Helena, Ascension and Tristan da Cunha",
            "code": "SH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SH.png",
            "active": true
        },
        {
            "id": 189,
            "dial_code": "+1",
            "name": "Saint Kitts and Nevis",
            "code": "KN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KN.png",
            "active": true
        },
        {
            "id": 191,
            "dial_code": "+1",
            "name": "Saint Lucia",
            "code": "LC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LC.png",
            "active": true
        },
        {
            "id": 192,
            "dial_code": "+590",
            "name": "Saint Martin (French part)",
            "code": "MF",
            "flag": null,
            "active": true
        },
        {
            "id": 193,
            "dial_code": "+508",
            "name": "Saint Pierre and Miquelon",
            "code": "PM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PM.png",
            "active": true
        },
        {
            "id": 194,
            "dial_code": "+1",
            "name": "Saint Vincent and the Grenadines",
            "code": "VC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VC.png",
            "active": true
        },
        {
            "id": 247,
            "dial_code": "+685",
            "name": "Samoa",
            "code": "WS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/WS.png",
            "active": true
        },
        {
            "id": 195,
            "dial_code": "+378",
            "name": "San Marino",
            "code": "SM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SM.png",
            "active": true
        },
        {
            "id": 196,
            "dial_code": "+239",
            "name": "Sao Tome and Principe",
            "code": "ST",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ST.png",
            "active": true
        },
        {
            "id": 197,
            "dial_code": "+966",
            "name": "Saudi Arabia",
            "code": "SA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SA.png",
            "active": true
        },
        {
            "id": 198,
            "dial_code": "+221",
            "name": "Senegal",
            "code": "SN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SN.png",
            "active": true
        },
        {
            "id": 199,
            "dial_code": "+381",
            "name": "Serbia",
            "code": "RS",
            "flag": null,
            "active": true
        },
        {
            "id": 200,
            "dial_code": "+248",
            "name": "Seychelles",
            "code": "SC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SC.png",
            "active": true
        },
        {
            "id": 201,
            "dial_code": "+232",
            "name": "Sierra Leone",
            "code": "SL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SL.png",
            "active": true
        },
        {
            "id": 202,
            "dial_code": "+65",
            "name": "Singapore",
            "code": "SG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SG.png",
            "active": true
        },
        {
            "id": 154,
            "dial_code": "+721",
            "name": "Sint Maarten (Dutch part)",
            "code": "SX",
            "flag": null,
            "active": true
        },
        {
            "id": 203,
            "dial_code": "+421",
            "name": "Slovakia",
            "code": "SK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SK.png",
            "active": true
        },
        {
            "id": 205,
            "dial_code": "+386",
            "name": "Slovenia",
            "code": "SI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SI.png",
            "active": true
        },
        {
            "id": 28,
            "dial_code": "+677",
            "name": "Solomon Islands",
            "code": "SB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SB.png",
            "active": true
        },
        {
            "id": 206,
            "dial_code": "+252",
            "name": "Somalia",
            "code": "SO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SO.png",
            "active": true
        },
        {
            "id": 207,
            "dial_code": "+27",
            "name": "South Africa",
            "code": "ZA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ZA.png",
            "active": true
        },
        {
            "id": 71,
            "dial_code": "+44",
            "name": "South Georgia and the South Sandwich Islands",
            "code": "GS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GS.png",
            "active": true
        },
        {
            "id": 210,
            "dial_code": "+211",
            "name": "South Sudan",
            "code": "SS",
            "flag": null,
            "active": true
        },
        {
            "id": 209,
            "dial_code": "+34",
            "name": "Spain",
            "code": "ES",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ES.png",
            "active": true
        },
        {
            "id": 41,
            "dial_code": "+94",
            "name": "Sri Lanka",
            "code": "LK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LK.png",
            "active": true
        },
        {
            "id": 211,
            "dial_code": "+249",
            "name": "Sudan",
            "code": "SD",
            "flag": null,
            "active": true
        },
        {
            "id": 213,
            "dial_code": "+597",
            "name": "Suriname",
            "code": "SR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SR.png",
            "active": true
        },
        {
            "id": 214,
            "dial_code": "+47",
            "name": "Svalbard and Jan Mayen",
            "code": "SJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SJ.png",
            "active": true
        },
        {
            "id": 215,
            "dial_code": "+268",
            "name": "Swaziland",
            "code": "SZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SZ.png",
            "active": true
        },
        {
            "id": 216,
            "dial_code": "+46",
            "name": "Sweden",
            "code": "SE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SE.png",
            "active": true
        },
        {
            "id": 217,
            "dial_code": "+41",
            "name": "Switzerland",
            "code": "CH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CH.png",
            "active": true
        },
        {
            "id": 218,
            "dial_code": "+963",
            "name": "Syrian Arab Republic",
            "code": "SY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SY.png",
            "active": true
        },
        {
            "id": 45,
            "dial_code": "+886",
            "name": "Taiwan, Province of China",
            "code": "TW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TW.png",
            "active": true
        },
        {
            "id": 219,
            "dial_code": "+992",
            "name": "Tajikistan",
            "code": "TJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TJ.png",
            "active": true
        },
        {
            "id": 239,
            "dial_code": "+255",
            "name": "Tanzania, United Republic of",
            "code": "TZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TZ.png",
            "active": true
        },
        {
            "id": 220,
            "dial_code": "+66",
            "name": "Thailand",
            "code": "TH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TH.png",
            "active": true
        },
        {
            "id": 180,
            "dial_code": "+670",
            "name": "Timor-Leste",
            "code": "TL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TL.png",
            "active": true
        },
        {
            "id": 221,
            "dial_code": "+228",
            "name": "Togo",
            "code": "TG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TG.png",
            "active": true
        },
        {
            "id": 222,
            "dial_code": "+690",
            "name": "Tokelau",
            "code": "TK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TK.png",
            "active": true
        },
        {
            "id": 223,
            "dial_code": "+676",
            "name": "Tonga",
            "code": "TO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TO.png",
            "active": true
        },
        {
            "id": 224,
            "dial_code": "+1",
            "name": "Trinidad and Tobago",
            "code": "TT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TT.png",
            "active": true
        },
        {
            "id": 226,
            "dial_code": "+216",
            "name": "Tunisia",
            "code": "TN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TN.png",
            "active": true
        },
        {
            "id": 227,
            "dial_code": "+90",
            "name": "Turkey",
            "code": "TR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TR.png",
            "active": true
        },
        {
            "id": 228,
            "dial_code": "+993",
            "name": "Turkmenistan",
            "code": "TM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TM.png",
            "active": true
        },
        {
            "id": 229,
            "dial_code": "+1",
            "name": "Turks and Caicos Islands",
            "code": "TC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TC.png",
            "active": true
        },
        {
            "id": 230,
            "dial_code": "+688",
            "name": "Tuvalu",
            "code": "TV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TV.png",
            "active": true
        },
        {
            "id": 231,
            "dial_code": "+256",
            "name": "Uganda",
            "code": "UG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UG.png",
            "active": true
        },
        {
            "id": 232,
            "dial_code": "+380",
            "name": "Ukraine",
            "code": "UA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UA.png",
            "active": true
        },
        {
            "id": 225,
            "dial_code": "+971",
            "name": "United Arab Emirates",
            "code": "AE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AE.png",
            "active": true
        },
        {
            "id": 235,
            "dial_code": "+44",
            "name": "United Kingdom",
            "code": "GB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GB.png",
            "active": true
        },
        {
            "id": 240,
            "dial_code": "+1",
            "name": "United States",
            "code": "US",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/US.png",
            "active": true
        },
        {
            "id": 166,
            "dial_code": "+1",
            "name": "United States Minor Outlying Islands",
            "code": "UM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UM.png",
            "active": true
        },
        {
            "id": 243,
            "dial_code": "+598",
            "name": "Uruguay",
            "code": "UY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UY.png",
            "active": true
        },
        {
            "id": 244,
            "dial_code": "+998",
            "name": "Uzbekistan",
            "code": "UZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UZ.png",
            "active": true
        },
        {
            "id": 157,
            "dial_code": "+678",
            "name": "Vanuatu",
            "code": "VU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VU.png",
            "active": true
        },
        {
            "id": 245,
            "dial_code": "+58",
            "name": "Venezuela, Bolivarian Republic of",
            "code": "VE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VE.png",
            "active": true
        },
        {
            "id": 204,
            "dial_code": "+84",
            "name": "Viet Nam",
            "code": "VN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VN.png",
            "active": true
        },
        {
            "id": 29,
            "dial_code": "+1",
            "name": "Virgin Islands, British",
            "code": "VG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VG.png",
            "active": true
        },
        {
            "id": 241,
            "dial_code": "+1",
            "name": "Virgin Islands, U.S.",
            "code": "VI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VI.png",
            "active": true
        },
        {
            "id": 246,
            "dial_code": "+681",
            "name": "Wallis and Futuna",
            "code": "WF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/WF.png",
            "active": true
        },
        {
            "id": 212,
            "dial_code": "+212",
            "name": "Western Sahara",
            "code": "EH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EH.png",
            "active": true
        },
        {
            "id": 248,
            "dial_code": "+967",
            "name": "Yemen",
            "code": "YE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/YE.png",
            "active": true
        },
        {
            "id": 249,
            "dial_code": "+260",
            "name": "Zambia",
            "code": "ZM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ZM.png",
            "active": true
        },
        {
            "id": 208,
            "dial_code": "+263",
            "name": "Zimbabwe",
            "code": "ZW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ZW.png",
            "active": true
        }
    ]
}
```

### HTTP Request
`GET api/v1/countries`


<!-- END_7a483081849344aa9cc1a1ce81ed9c3f -->

#Dispatcher-trips-apis


APIs for Dispatcher-trips apis
<!-- START_f21e5bfeb7f8d871ee2045f6c078e664 -->
## Create Request

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/dispatcher/request/create" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"pick_lat":85.53,"pick_lng":0.62,"drop_lat":71040446.492,"drop_lng":27663750.1589,"drivers":"dolor","vehicle_type":"unde","ride_type":"et","payment_opt":"sed","pick_address":"harum","drop_address":"omnis"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/dispatcher/request/create"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pick_lat": 85.53,
    "pick_lng": 0.62,
    "drop_lat": 71040446.492,
    "drop_lng": 27663750.1589,
    "drivers": "dolor",
    "vehicle_type": "unde",
    "ride_type": "et",
    "payment_opt": "sed",
    "pick_address": "harum",
    "drop_address": "omnis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
        "request_number": "REQ_000002",
        "is_later": 0,
        "user_id": 15,
        "trip_start_time": "5th Aug 09:54 PM",
        "arrived_at": null,
        "accepted_at": null,
        "completed_at": "5th Aug 11:49 PM",
        "is_driver_started": 0,
        "is_driver_arrived": 0,
        "is_trip_start": 0,
        "is_completed": 1,
        "is_cancelled": 0,
        "cancel_method": "0",
        "payment_opt": "1",
        "is_paid": 1,
        "user_rated": 0,
        "driver_rated": 0,
        "unit": "0",
        "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
        "vehicle_type_name": "Mini",
        "pick_lat": 11.0797,
        "pick_lng": 76.9997,
        "drop_lat": 11.41157598,
        "drop_lng": 76.77196096,
        "pick_address": "gandhi puram",
        "drop_address": "saravanm patti"
    }
}
```

### HTTP Request
`POST api/v1/dispatcher/request/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `pick_lat` | float |  required  | pikup lat of the user
        `pick_lng` | float |  required  | pikup lng of the user
        `drop_lat` | float |  required  | drop lat of the user
        `drop_lng` | float |  required  | drop lng of the user
        `drivers` | json |  required  | drivers json can be fetch from firebase db
        `vehicle_type` | string |  required  | id of zone_type_id
        `ride_type` | tinyInteger |  required  | type of ride whther ride now or scheduele trip
        `payment_opt` | tinyInteger |  required  | type of ride whther cash or card, wallet('0 => card,1 => cash,2 => wallet)
        `pick_address` | string |  required  | pickup address of the trip request
        `drop_address` | string |  required  | drop address of the trip request
    
<!-- END_f21e5bfeb7f8d871ee2045f6c078e664 -->

#Driver-trips-apis


APIs for Driver-trips apis
<!-- START_8a75b3ff568f4ada08773791fb7e2d70 -->
## Driver Response for Trip Request

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/respond" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"request_id":"omnis","is_accept":false}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/respond"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request_id": "omnis",
    "is_accept": false
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/request/respond`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request_id` | uuid |  required  | id request
        `is_accept` | boolean |  required  | response of request i.e accept or reject. input should be 0 or 1.
    
<!-- END_8a75b3ff568f4ada08773791fb7e2d70 -->

<!-- START_9c8cf787e32d79b570fa045c9f320fad -->
## Driver Arrived

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/arrived" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"request_id":"aspernatur"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/arrived"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request_id": "aspernatur"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "driver_arrived"
}
```

### HTTP Request
`POST api/v1/request/arrived`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request_id` | uuid |  required  | id request
    
<!-- END_9c8cf787e32d79b570fa045c9f320fad -->

<!-- START_7e42ec7da13ede5b5f29253df7511153 -->
## Driver Trip started

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/started" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"request_id":"tenetur","pick_lat":18445713.925125,"pick_lng":635572102.35793,"pick_address":"sit"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/started"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request_id": "tenetur",
    "pick_lat": 18445713.925125,
    "pick_lng": 635572102.35793,
    "pick_address": "sit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "driver_trip_started"
}
```

### HTTP Request
`POST api/v1/request/started`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request_id` | uuid |  required  | id of request
        `pick_lat` | float |  required  | pikup lat of the user
        `pick_lng` | float |  required  | pikup lng of the user
        `pick_address` | string |  optional  | optional pickup address of the trip request
    
<!-- END_7e42ec7da13ede5b5f29253df7511153 -->

<!-- START_0ce016e22c28f1f390cde70476ed2928 -->
## Driver Cancel Trip Request

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/cancel/by-driver" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"request_id":"hic","reason":"consectetur","custom_reason":"qui"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/cancel/by-driver"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request_id": "hic",
    "reason": "consectetur",
    "custom_reason": "qui"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "driver_cancelled_trip"
}
```

### HTTP Request
`POST api/v1/request/cancel/by-driver`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request_id` | uuid |  required  | id of request
        `reason` | string |  optional  | optional reason provided by user
        `custom_reason` | string |  optional  | optional custom reason provided by user
    
<!-- END_0ce016e22c28f1f390cde70476ed2928 -->

<!-- START_6e899b4e75a219dbe772310531462adf -->
## Driver End Request

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/end" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"request_id":"placeat","distance":75714559,"before_arrival_waiting_time":3713.324910278,"after_arrival_waiting_time":4.27935576,"drop_lat":2893120.96,"drop_lng":9338.482109172,"drop_address":5675.1}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/end"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request_id": "placeat",
    "distance": 75714559,
    "before_arrival_waiting_time": 3713.324910278,
    "after_arrival_waiting_time": 4.27935576,
    "drop_lat": 2893120.96,
    "drop_lng": 9338.482109172,
    "drop_address": 5675.1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "request_ended",
    "data": {
        "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
        "request_number": "REQ_000002",
        "is_later": 0,
        "user_id": 15,
        "trip_start_time": "5th Aug 09:54 PM",
        "arrived_at": null,
        "accepted_at": null,
        "total_distance": 5.65,
        "total_time": 47,
        "completed_at": "5th Aug 11:35 PM",
        "is_driver_started": 0,
        "is_driver_arrived": 0,
        "is_trip_start": 0,
        "is_completed": true,
        "is_cancelled": 0,
        "cancel_method": "0",
        "payment_opt": "1",
        "is_paid": true,
        "user_rated": 0,
        "driver_rated": 0,
        "unit": "MILES",
        "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
        "vehicle_type_name": "Mini",
        "pick_lat": 11.0797,
        "pick_lng": 76.9997,
        "drop_lat": "11.411575977701146",
        "drop_lng": "76.771960957047312",
        "pick_address": "gandhi puram",
        "drop_address": "saravanm patti",
        "requestBill": {
            "data": {
                "id": 1,
                "base_price": 5,
                "base_distance": 5,
                "price_per_distance": 5,
                "distance_price": 398.44,
                "price_per_time": 5,
                "time_price": 500,
                "waiting_charge": 100,
                "cancellation_fee": 0,
                "service_tax": 299.53,
                "service_tax_percentage": 30,
                "promo_discount": 0,
                "admin_commision": 299.53,
                "driver_commision": 998.45,
                "total_amount": 1597.51,
                "requested_currency_code": "INR",
                "admin_commision_with_tax": 599.07
            }
        }
    }
}
```

### HTTP Request
`POST api/v1/request/end`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request_id` | uuid |  required  | id request
        `distance` | float |  required  | distance of request
        `before_arrival_waiting_time` | float |  required  | before arrival waiting time of request
        `after_arrival_waiting_time` | float |  required  | after arrival waiting time of request
        `drop_lat` | float |  required  | drop lattitude of request
        `drop_lng` | float |  required  | drop longitude of request
        `drop_address` | float |  required  | drop drop Address of request
    
<!-- END_6e899b4e75a219dbe772310531462adf -->

<!-- START_af5bcb8e1f0943e841fcbe0f1e203fdd -->
## Online-Offline driver

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/driver/online-offline" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/online-offline"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "offline-success",
    "data": {
        "id": 6,
        "name": "dilipdk",
        "email": "driver1@gmail.com",
        "mobile": "8667259868",
        "profile_picture": null,
        "active": false,
        "approve": true,
        "available": false,
        "uploaded_document": false,
        "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
        "vehicle_type_id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
        "vehicle_type_name": "Mini",
        "car_make": null,
        "car_model": null,
        "car_make_name": null,
        "car_model_name": null,
        "car_color": null,
        "car_number": null
    }
}
```
> Example response (200):

```json
{
    "success": true,
    "message": "online-success",
    "data": {
        "id": 6,
        "name": "dilipdk",
        "email": "driver1@gmail.com",
        "mobile": "8667259868",
        "profile_picture": null,
        "active": true,
        "approve": true,
        "available": false,
        "uploaded_document": false,
        "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
        "vehicle_type_id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
        "vehicle_type_name": "Mini",
        "car_make": null,
        "car_model": null,
        "car_make_name": null,
        "car_model_name": null,
        "car_color": null,
        "car_number": null
    }
}
```

### HTTP Request
`POST api/v1/driver/online-offline`


<!-- END_af5bcb8e1f0943e841fcbe0f1e203fdd -->

#Driver Document Management


APIs for DriverNeededDocument's
<!-- START_bffe76edf468bc03f81d8d27d3689264 -->
## Get All documents needed to be uploaded

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/driver/documents/needed" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/documents/needed"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "enable_submit_button": false,
    "data": [
        {
            "id": 1,
            "name": "License",
            "doc_type": "image",
            "has_identify_number": true,
            "has_expiry_date": true,
            "active": 1,
            "identify_number_locale_key": "identification number",
            "is_uploaded": true,
            "document_status": 4,
            "document_status_string": "Reuploaded And Waiting For Approval",
            "driver_document": {
                "data": {
                    "id": "5b0134b6-e587-4c12-a85c-192f7a4cb319",
                    "document_id": 1,
                    "document_name": "License",
                    "document": "http:\/\/localhost\/future\/public\/storage\/uploads\/driver\/documents\/6\/qicbTf4bO69sFEPSmfy7eJasMHh1WnQIwaGuBRER.jpg",
                    "identify_number": "14578",
                    "expiry_date": "2020-08-13",
                    "comment": null,
                    "document_status": 4,
                    "document_status_string": "Reuploaded And Waiting For Approval"
                }
            }
        },
        {
            "id": 2,
            "name": "Rc Book",
            "doc_type": "image",
            "has_identify_number": false,
            "has_expiry_date": true,
            "active": 1,
            "identify_number_locale_key": null,
            "is_uploaded": false,
            "document_status": 2,
            "document_status_string": "Not Uploaded",
            "driver_document": null
        }
    ]
}
```

### HTTP Request
`GET api/v1/driver/documents/needed`


<!-- END_bffe76edf468bc03f81d8d27d3689264 -->

<!-- START_9da51b214f86f6f5c1df281209e63fde -->
## Upload Driver&#039;s Document

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/driver/upload/documents" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"document_id":3,"identify_number":"et","expiry_date":"amet","document":"non"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/upload/documents"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "document_id": 3,
    "identify_number": "et",
    "expiry_date": "amet",
    "document": "non"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/driver/upload/documents`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `document_id` | integer |  required  | id of the documents needed uploaded
        `identify_number` | string |  optional  | optional identify number of the document, required sometimes depends on the document
        `expiry_date` | date |  required  | expiry date of the document, the date should be in the format "date_format:Y-m-d H:i:s", eg:2020-08-13 00:00:00
        `document` | image |  required  | document file provided by user
    
<!-- END_9da51b214f86f6f5c1df281209e63fde -->

#Driver Earnings


APIs for Driver's Earnings
<!-- START_9466a70e461317c6f71c819b5b461746 -->
## Today-Earnings

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/driver/today-earnings" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/today-earnings"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "current_date": "5th Oct 2020",
        "total_trips_count": 1,
        "total_trip_kms": 14,
        "total_earnings": 1073.44,
        "total_cash_trip_amount": 1073.44,
        "total_wallet_trip_amount": 0,
        "total_cash_trip_count": 1,
        "total_wallet_trip_count": 0,
        "currency_symbol": "₹"
    }
}
```

### HTTP Request
`GET api/v1/driver/today-earnings`


<!-- END_9466a70e461317c6f71c819b5b461746 -->

<!-- START_435905b380d6c5c1615a175225aa9cd4 -->
## Weekly Earnings

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/driver/weekly-earnings" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/weekly-earnings"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "week_days": {
            "monday": 1073.44,
            "tuesday": 0,
            "wednesday": 0,
            "thursday": 0,
            "friday": 0,
            "saturday": 0,
            "sunday": 0
        },
        "current_date": "12th Oct 2020",
        "current_week_number": 41,
        "start_of_week": "5th Oct 2020",
        "end_of_week": "11th Oct 2020",
        "disable_next_week": true,
        "disable_previous_week": false,
        "total_trips_count": 1,
        "total_trip_kms": 14,
        "total_earnings": 1073.44,
        "total_cash_trip_amount": 1073.44,
        "total_wallet_trip_amount": 0,
        "total_cash_trip_count": 1,
        "total_wallet_trip_count": 0,
        "currency_symbol": "₹"
    }
}
```

### HTTP Request
`GET api/v1/driver/weekly-earnings`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `week_number` |  optional  | integer week number of year

<!-- END_435905b380d6c5c1615a175225aa9cd4 -->

<!-- START_4149df365f39171eff4a92a15f1c0d7e -->
## Earnings Report

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/driver/earnings-report/adipisci/molestias" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/earnings-report/adipisci/molestias"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "from_date": "5th Oct 2020",
        "to_date": "11th Oct 2020",
        "total_trips_count": 1,
        "total_trip_kms": 14,
        "total_earnings": 1073.44,
        "total_cash_trip_amount": 1073.44,
        "total_wallet_trip_amount": 0,
        "total_cash_trip_count": 1,
        "total_wallet_trip_count": 0,
        "currency_symbol": "₹"
    }
}
```

### HTTP Request
`GET api/v1/driver/earnings-report/{from_date}/{to_date}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `from_date` |  optional  | date date string
    `to_date` |  optional  | date date string

<!-- END_4149df365f39171eff4a92a15f1c0d7e -->

#Email-Confirmation


APIs for Email-Confirmation
<!-- START_77e45a4c51c84889ebb319ba3a116978 -->
## Confirm user&#039;s email using the confirmation token.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/email/confirm" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"token":"tenetur","email":"ea"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/email/confirm"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "tenetur",
    "email": "ea"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/email/confirm`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | token of the email
        `email` | string |  required  | email of the user entered
    
<!-- END_77e45a4c51c84889ebb319ba3a116978 -->

<!-- START_8685dad8976b82d13ff3ab36da415842 -->
## Resend user&#039;s email address confirmation email.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/email/resend-confirmation" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"quis"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/email/resend-confirmation"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "quis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/email/resend-confirmation`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | email of the user entered
    
<!-- END_8685dad8976b82d13ff3ab36da415842 -->

#FAQ


APIs for faq lists for user & driver
<!-- START_57c16c7f1f6a3d54f72f00bb2dfced50 -->
## List Faq

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/common/faq/list/eum/aut" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/faq/list/eum/aut"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "2dabbc46-dac2-41e3-b35a-b671d8db3bde",
            "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
            "question": "wbevejhefbwefmbef",
            "answer": "qekjfbqefbqff",
            "user_type": "both",
            "active": true
        },
        {
            "id": "4f3d4cb1-29f6-49c9-aff4-dffe0681828e",
            "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
            "question": "test dklfhbvkeg b?",
            "answer": "etstkewnlfkwrg",
            "user_type": "user",
            "active": true
        }
    ],
    "meta": {
        "pagination": {
            "total": 2,
            "count": 2,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET api/v1/common/faq/list/{lat}/{lng}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `lat` |  required  | double  latitude provided by user
    `lng` |  required  | double  longitude provided by user

<!-- END_57c16c7f1f6a3d54f72f00bb2dfced50 -->

#Password-Reset


APIs for Email-Management
<!-- START_8d38f20195c047b34f8d4e3b932a993e -->
## Send the password reset email to the user.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/password/forgot" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"commodi"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/password/forgot"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "commodi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/password/forgot`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | email |  required  | email of the user entered
    
<!-- END_8d38f20195c047b34f8d4e3b932a993e -->

<!-- START_e136defca3005c2cee725b660f83f3a8 -->
## Validate the password reset token.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/password/validate-token" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"token":"eius","email":"inventore"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/password/validate-token"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "eius",
    "email": "inventore"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/password/validate-token`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | token of the email
        `email` | string |  required  | email of the user entered
    
<!-- END_e136defca3005c2cee725b660f83f3a8 -->

<!-- START_a62f1703e9fba891a3e20ff27854aac0 -->
## Validate the password reset token and update the password.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/password/reset" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/password/reset"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/password/reset`


<!-- END_a62f1703e9fba891a3e20ff27854aac0 -->

#Payment


Payment-Related Apis
<!-- START_fda2d6311fc1b17b94e1b8c1a904bac8 -->
## User-Add Card

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/payment/card/add" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"payment_nonce":"ullam"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/payment/card/add"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_nonce": "ullam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "card_added_succesfully",
    "data": [
        {
            "id": "33f6a61d-4ddc-47dc-a601-250672dbc405",
            "customer_id": "customer_765_6",
            "merchant_id": "pwc2hd46g93s4zy2",
            "card_token": "79dhmq",
            "last_number": 521,
            "card_type": "VISA",
            "valid_through": "12\/2021",
            "user_id": 6,
            "is_default": 0,
            "user_role": "driver",
            "created_at": "2019-05-06 13:17:40",
            "updated_at": "2019-05-06 13:17:40",
            "deleted_at": null
        }
    ]
}
```

### HTTP Request
`POST api/v1/payment/card/add`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `payment_nonce` | string |  required  | Payment nonce fron entered value
    
<!-- END_fda2d6311fc1b17b94e1b8c1a904bac8 -->

<!-- START_0eb39eaf02e2c90ac37f8a91d7219ded -->
## List cards

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/payment/card/list" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/payment/card/list"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "card_listed_succesfully",
    "data": [
        {
            "id": "33f6a61d-4ddc-47dc-a601-250672dbc405",
            "customer_id": "customer_765_6",
            "merchant_id": "pwc2hd46g93s4zy2",
            "card_token": "79dhmq",
            "last_number": 521,
            "card_type": "VISA",
            "user_id": 6,
            "is_default": 0,
            "user_role": "driver",
            "valid_through": "12\/2021",
            "created_at": "2019-05-06 13:17:40",
            "updated_at": "2019-05-06 13:17:40",
            "deleted_at": null
        }
    ]
}
```

### HTTP Request
`GET api/v1/payment/card/list`


<!-- END_0eb39eaf02e2c90ac37f8a91d7219ded -->

<!-- START_a60289582f4878cd515bf4058273c1ca -->
## Make card as default card

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/payment/card/make/default" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"card_id":"aut"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/payment/card/make/default"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "card_id": "aut"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "card_made_default_succesfully"
}
```

### HTTP Request
`POST api/v1/payment/card/make/default`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `card_id` | uuid |  required  | card id choosen by user
    
<!-- END_a60289582f4878cd515bf4058273c1ca -->

<!-- START_6baea63b0b93a5a65e15ebb9d7a14cff -->
## Delete Card

> Example request:

```bash
curl -X DELETE \
    "http://localhost/future/public/api/v1/payment/card/delete/1" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/payment/card/delete/1"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "card_deleted_succesfully"
}
```

### HTTP Request
`DELETE api/v1/payment/card/delete/{card}`


<!-- END_6baea63b0b93a5a65e15ebb9d7a14cff -->

<!-- START_d03d69737bfb8923b60210cfdecb88ef -->
## Get Client token for brain tree

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/payment/client/token" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/payment/client/token"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "client_token": "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpGVXpJMU5pSXNJbXRwWkNJNklqSXdNVGd3TkRJMk1UWXRjMkZ1WkdKdmVDSXNJbWx6Y3lJNklrRjFkR2g1SW4wLmV5SmxlSEFpT2pFMU9URTBOalE1TnpZc0ltcDBhU0k2SWpGbFpUZG1aREExTFRJNU1qRXRORGt4TWkxaFlXSmpMVEJtTTJVMVpUVXlPVEkzWVNJc0luTjFZaUk2SW5CM1l6Sm9aRFEyWnpremN6UjZlVElpTENKcGMzTWlPaUpCZFhSb2VTSXNJb"
    }
}
```

### HTTP Request
`GET api/v1/payment/client/token`


<!-- END_d03d69737bfb8923b60210cfdecb88ef -->

<!-- START_7ea328f50d57a7fed7fd90e7d1b505ff -->
## Add money to wallet

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/payment/wallet/add/money" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"amount":334867074.379391,"card_id":"libero"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/payment/wallet/add/money"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": 334867074.379391,
    "card_id": "libero"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "money_added_successfully",
    "data": {
        "id": "1195a787-ba13-4a74-b56c-c48ba4ca0ca0",
        "user_id": 15,
        "amount_added": 2500,
        "amount_balance": 2500,
        "amount_spent": 0,
        "currency_code": "INR",
        "created_at": "1st Sep 10:45 PM",
        "updated_at": "1st Sep 10:51 PM"
    }
}
```

### HTTP Request
`POST api/v1/payment/wallet/add/money`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `amount` | float |  required  | amount entered by user
        `card_id` | uuid |  required  | card_id choosed by user
    
<!-- END_7ea328f50d57a7fed7fd90e7d1b505ff -->

<!-- START_05f42aa84aef5ea97dd37a2534dbebd2 -->
## Wallet history

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/payment/wallet/history" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/payment/wallet/history"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "wallet_history_listed",
    "wallet_balance": 5500,
    "default_card_id": "cb26f413-3dcb-44e5-9976-c41d0547214b",
    "currency_code": "INR",
    "currency_symbol": "₹",
    "wallet_history": {
        "data": [
            {
                "id": "ec102ac8-7ceb-4a9b-999f-8461933f814c",
                "user_id": 15,
                "card_id": "cb26f413-3dcb-44e5-9976-c41d0547214b",
                "transaction_id": "nwz56dbv",
                "amount": 1500,
                "conversion": "INR-USD:1500-20.42",
                "merchant": "nplustechnologies",
                "remarks": "Money Deposited",
                "is_credit": 1,
                "created_at": "4th Sep 01:07 PM",
                "updated_at": "4th Sep 01:07 PM"
            },
            {
                "id": "5d08d769-21ac-4dc3-a56c-0ac0eef4b0c2",
                "user_id": 15,
                "card_id": "cb26f413-3dcb-44e5-9976-c41d0547214b",
                "transaction_id": "5qmad4pe",
                "amount": 1500,
                "conversion": "INR-USD:1500-20.42",
                "merchant": "nplustechnologies",
                "remarks": "Money Deposited",
                "is_credit": 0,
                "created_at": "4th Sep 12:53 PM",
                "updated_at": "4th Sep 12:53 PM"
            },
            {
                "id": "6be510e7-436d-4daf-a711-b3d17fb68452",
                "user_id": 15,
                "card_id": "cb26f413-3dcb-44e5-9976-c41d0547214b",
                "transaction_id": "pd4hv6kh",
                "amount": 1500,
                "conversion": "INR-USD:1500-20.53",
                "merchant": "nplustechnologies",
                "remarks": null,
                "is_credit": 0,
                "created_at": "1st Sep 10:51 PM",
                "updated_at": "1st Sep 10:51 PM"
            },
            {
                "id": "01dc4bdd-154f-43b9-80d2-88de6354ff45",
                "user_id": 15,
                "card_id": "cb26f413-3dcb-44e5-9976-c41d0547214b",
                "transaction_id": "0rncvw9n",
                "amount": 1000,
                "conversion": "INR-USD:1000-13.69",
                "merchant": "nplustechnologies",
                "remarks": null,
                "is_credit": 0,
                "created_at": "1st Sep 10:45 PM",
                "updated_at": "1st Sep 10:45 PM"
            }
        ],
        "meta": {
            "pagination": {
                "total": 4,
                "count": 4,
                "per_page": 10,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
        }
    }
}
```

### HTTP Request
`GET api/v1/payment/wallet/history`


<!-- END_05f42aa84aef5ea97dd37a2534dbebd2 -->

#Profile-Management


APIs for Profile-Management
<!-- START_3da20b53e7ac009a16bd3015dd822453 -->
## Update user password.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/password" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"old_password":"perferendis","password":"quisquam","password_confirmation":"recusandae"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/password"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "old_password": "perferendis",
    "password": "quisquam",
    "password_confirmation": "recusandae"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/user/password`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `old_password` | password |  required  | old_password provided user
        `password` | password |  required  | password provided user
        `password_confirmation` | password |  required  | confirmed password provided user
    
<!-- END_3da20b53e7ac009a16bd3015dd822453 -->

<!-- START_0dfeb5eebc3d94d959f79f1961830247 -->
## Update user profile.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/profile" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/profile"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/user/profile`


<!-- END_0dfeb5eebc3d94d959f79f1961830247 -->

<!-- START_4c9e8362a66485b8949bf4dcd130f220 -->
## Update Driver Profile

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/driver-profile" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/driver-profile"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/user/driver-profile`


<!-- END_4c9e8362a66485b8949bf4dcd130f220 -->

<!-- START_fed361664bd3c0baf40add5336af57a6 -->
## Update My Language

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/update-my-lang" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"lang":"itaque"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/update-my-lang"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "lang": "itaque"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/user/update-my-lang`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `lang` | string |  required  | language provided user
    
<!-- END_fed361664bd3c0baf40add5336af57a6 -->

#Ratings


APIs for User & Driver-trip ratig api
<!-- START_1c6374c0daf377bc495cdcf0ace7bdb0 -->
## Rate The Request B/W User &amp; Driver

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/rating" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"request_id":"aspernatur","rating":10.873,"comment":"voluptas"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/rating"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request_id": "aspernatur",
    "rating": 10.873,
    "comment": "voluptas"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "rated_successfully"
}
```

### HTTP Request
`POST api/v1/request/rating`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request_id` | uuid |  required  | id of request
        `rating` | float |  required  | rating of the request
        `comment` | string |  optional  | optional comment of the request
    
<!-- END_1c6374c0daf377bc495cdcf0ace7bdb0 -->

#Request-Histories


APIs request history list & history by request id
<!-- START_28c3a465e188ac303fc46dc13ae5dabb -->
## Get Request detail by request id

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/adhoc-request/history/1" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/adhoc-request/history/1"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`GET api/v1/adhoc-request/history/{id}`


<!-- END_28c3a465e188ac303fc46dc13ae5dabb -->

<!-- START_277faa86282ab149538a267c45e82297 -->
## Request History List

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/request/history" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/history"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
            "request_number": "REQ_000002",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": "5th Aug 09:54 PM",
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": "5th Aug 11:49 PM",
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 1,
            "is_cancelled": 0,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 1,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 11.41157598,
            "drop_lng": 76.77196096,
            "pick_address": "gandhi puram",
            "drop_address": "saravanm patti",
            "driverDetail": {
                "data": {
                    "id": 6,
                    "name": "dilipdk",
                    "email": "driver1@gmail.com",
                    "mobile": "8667259868",
                    "profile_picture": "http:\/\/localhost\/future\/public\/assets\/images\/default-profile-picture.png",
                    "active": false,
                    "approve": true,
                    "available": true,
                    "uploaded_document": false,
                    "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
                    "vehicle_type_id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
                    "vehicle_type_name": "Mini",
                    "car_make": null,
                    "car_model": null,
                    "car_make_name": null,
                    "car_model_name": null,
                    "car_color": null,
                    "car_number": null
                }
            },
            "requestBill": {
                "data": {
                    "id": 1,
                    "base_price": 5,
                    "base_distance": 5,
                    "price_per_distance": 5,
                    "distance_price": 398.44,
                    "price_per_time": 5,
                    "time_price": 575,
                    "waiting_charge": 100,
                    "cancellation_fee": 0,
                    "service_tax": 322.03,
                    "service_tax_percentage": 30,
                    "promo_discount": 0,
                    "admin_commision": 322.03,
                    "driver_commision": 1073.44,
                    "total_amount": 1717.51,
                    "requested_currency_code": "INR",
                    "admin_commision_with_tax": 644.07
                }
            }
        },
        {
            "id": "2b4c305a-c2a7-4dd4-96ab-dcbc6ec12d29",
            "request_number": "REQ_000006",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": null,
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": null,
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 0,
            "is_cancelled": 1,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 0,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 10.99693444,
            "drop_lng": 76.9762592,
            "pick_address": "gandhi puram",
            "drop_address": "srp mills",
            "driverDetail": null,
            "requestBill": null
        },
        {
            "id": "4b4df4df-dee5-463e-9bde-237a2fab1611",
            "request_number": "REQ_000004",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": null,
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": null,
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 0,
            "is_cancelled": 1,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 0,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 10.99693444,
            "drop_lng": 76.9762592,
            "pick_address": "gandhi puram",
            "drop_address": "srp mills",
            "driverDetail": null,
            "requestBill": null
        },
        {
            "id": "616f4430-15c3-4fac-b584-590634f35154",
            "request_number": "REQ_000008",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": null,
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": null,
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 0,
            "is_cancelled": 1,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 0,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 10.99693444,
            "drop_lng": 76.9762592,
            "pick_address": "gandhi puram",
            "drop_address": "srp mills",
            "driverDetail": null,
            "requestBill": null
        },
        {
            "id": "d04024fd-3608-48e5-94f1-46d1ed105872",
            "request_number": "REQ_000005",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": null,
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": null,
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 0,
            "is_cancelled": 1,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 0,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 10.99693444,
            "drop_lng": 76.9762592,
            "pick_address": "gandhi puram",
            "drop_address": "srp mills",
            "driverDetail": null,
            "requestBill": null
        },
        {
            "id": "d941b252-48be-4b04-b969-35ff00044f3d",
            "request_number": "REQ_000001",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": null,
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": null,
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 0,
            "is_cancelled": 1,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 0,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 10.99693444,
            "drop_lng": 76.9762592,
            "pick_address": "gandhi puram",
            "drop_address": "srp mills",
            "driverDetail": null,
            "requestBill": null
        },
        {
            "id": "fc3c94b0-e92b-4dea-b49b-98d28cd8bd6d",
            "request_number": "REQ_000003",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": null,
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": null,
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 0,
            "is_cancelled": 1,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 0,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 10.99693444,
            "drop_lng": 76.9762592,
            "pick_address": "gandhi puram",
            "drop_address": "srp mills",
            "driverDetail": null,
            "requestBill": null
        }
    ],
    "meta": {
        "pagination": {
            "total": 7,
            "count": 7,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```
> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
            "request_number": "REQ_000002",
            "is_later": 0,
            "user_id": 15,
            "trip_start_time": "5th Aug 09:54 PM",
            "arrived_at": null,
            "accepted_at": null,
            "completed_at": "5th Aug 11:49 PM",
            "is_driver_started": 0,
            "is_driver_arrived": 0,
            "is_trip_start": 0,
            "is_completed": 1,
            "is_cancelled": 0,
            "cancel_method": "0",
            "payment_opt": "1",
            "is_paid": 1,
            "user_rated": 0,
            "driver_rated": 0,
            "unit": "0",
            "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
            "vehicle_type_name": "Mini",
            "pick_lat": 11.0797,
            "pick_lng": 76.9997,
            "drop_lat": 11.41157598,
            "drop_lng": 76.77196096,
            "pick_address": "gandhi puram",
            "drop_address": "saravanm patti",
            "userDetail": {
                "data": {
                    "id": 15,
                    "name": "Test Test",
                    "last_name": null,
                    "username": null,
                    "email": "testa@gmail.com",
                    "mobile": "9878987812",
                    "profile_picture": "http:\/\/localhost\/future\/public\/assets\/images\/default-profile-picture.png",
                    "active": 1,
                    "email_confirmed": 0,
                    "mobile_confirmed": 1,
                    "last_known_ip": "::1",
                    "last_login_at": "2020-08-05 11:26:35"
                }
            },
            "requestBill": {
                "data": {
                    "id": 1,
                    "base_price": 5,
                    "base_distance": 5,
                    "price_per_distance": 5,
                    "distance_price": 398.44,
                    "price_per_time": 5,
                    "time_price": 575,
                    "waiting_charge": 100,
                    "cancellation_fee": 0,
                    "service_tax": 322.03,
                    "service_tax_percentage": 30,
                    "promo_discount": 0,
                    "admin_commision": 322.03,
                    "driver_commision": 1073.44,
                    "total_amount": 1717.51,
                    "requested_currency_code": "INR",
                    "admin_commision_with_tax": 644.07
                }
            }
        }
    ],
    "meta": {
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET api/v1/request/history`


<!-- END_277faa86282ab149538a267c45e82297 -->

<!-- START_22b626e680480e338bb94699f676124a -->
## Single Request History by request id

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/request/history/1" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/history/1"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
        "request_number": "REQ_000002",
        "is_later": 0,
        "user_id": 15,
        "trip_start_time": "5th Aug 09:54 PM",
        "arrived_at": null,
        "accepted_at": null,
        "completed_at": "5th Aug 11:49 PM",
        "is_driver_started": 0,
        "is_driver_arrived": 0,
        "is_trip_start": 0,
        "is_completed": 1,
        "is_cancelled": 0,
        "cancel_method": "0",
        "payment_opt": "1",
        "is_paid": 1,
        "user_rated": 0,
        "driver_rated": 0,
        "unit": "0",
        "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
        "vehicle_type_name": "Mini",
        "pick_lat": 11.0797,
        "pick_lng": 76.9997,
        "drop_lat": 11.41157598,
        "drop_lng": 76.77196096,
        "pick_address": "gandhi puram",
        "drop_address": "saravanm patti",
        "driverDetail": {
            "data": {
                "id": 6,
                "name": "dilipdk",
                "email": "driver1@gmail.com",
                "mobile": "8667259868",
                "profile_picture": "http:\/\/localhost\/future\/public\/assets\/images\/default-profile-picture.png",
                "active": false,
                "approve": true,
                "available": true,
                "uploaded_document": false,
                "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
                "vehicle_type_id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
                "vehicle_type_name": "Mini",
                "car_make": null,
                "car_model": null,
                "car_make_name": null,
                "car_model_name": null,
                "car_color": null,
                "car_number": null
            }
        },
        "requestBill": {
            "data": {
                "id": 1,
                "base_price": 5,
                "base_distance": 5,
                "price_per_distance": 5,
                "distance_price": 398.44,
                "price_per_time": 5,
                "time_price": 575,
                "waiting_charge": 100,
                "cancellation_fee": 0,
                "service_tax": 322.03,
                "service_tax_percentage": 30,
                "promo_discount": 0,
                "admin_commision": 322.03,
                "driver_commision": 1073.44,
                "total_amount": 1717.51,
                "requested_currency_code": "INR",
                "admin_commision_with_tax": 644.07
            }
        }
    }
}
```
> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
        "request_number": "REQ_000002",
        "is_later": 0,
        "user_id": 15,
        "trip_start_time": "5th Aug 09:54 PM",
        "arrived_at": null,
        "accepted_at": null,
        "completed_at": "5th Aug 11:49 PM",
        "is_driver_started": 0,
        "is_driver_arrived": 0,
        "is_trip_start": 0,
        "is_completed": 1,
        "is_cancelled": 0,
        "cancel_method": "0",
        "payment_opt": "1",
        "is_paid": 1,
        "user_rated": 0,
        "driver_rated": 0,
        "unit": "0",
        "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
        "vehicle_type_name": "Mini",
        "pick_lat": 11.0797,
        "pick_lng": 76.9997,
        "drop_lat": 11.41157598,
        "drop_lng": 76.77196096,
        "pick_address": "gandhi puram",
        "drop_address": "saravanm patti",
        "userDetail": {
            "data": {
                "id": 15,
                "name": "Test Test",
                "last_name": null,
                "username": null,
                "email": "testa@gmail.com",
                "mobile": "9878987812",
                "profile_picture": "http:\/\/localhost\/future\/public\/assets\/images\/default-profile-picture.png",
                "active": 1,
                "email_confirmed": 0,
                "mobile_confirmed": 1,
                "last_known_ip": "::1",
                "last_login_at": "2020-08-05 11:26:35"
            }
        },
        "requestBill": {
            "data": {
                "id": 1,
                "base_price": 5,
                "base_distance": 5,
                "price_per_distance": 5,
                "distance_price": 398.44,
                "price_per_time": 5,
                "time_price": 575,
                "waiting_charge": 100,
                "cancellation_fee": 0,
                "service_tax": 322.03,
                "service_tax_percentage": 30,
                "promo_discount": 0,
                "admin_commision": 322.03,
                "driver_commision": 1073.44,
                "total_amount": 1717.51,
                "requested_currency_code": "INR",
                "admin_commision_with_tax": 644.07
            }
        }
    }
}
```

### HTTP Request
`GET api/v1/request/history/{id}`


<!-- END_22b626e680480e338bb94699f676124a -->

#ServiceLocations


Get ServiceLocatons
<!-- START_af8489dfff9eec85451636ea9ea6e1b2 -->
## Get all the ServiceLocatons.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/servicelocation" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/servicelocation"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "data": [
        {
            "id": "47d7b3bc-cfc2-4400-8d2c-640f6c06343e",
            "name": "trippur",
            "currency_name": "Indian rupee",
            "currency_symbol": "₹",
            "timezone": "Asia\/Kolkata",
            "active": 1
        },
        {
            "id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
            "name": "Coimbatore",
            "currency_name": "Indian rupee",
            "currency_symbol": "₹",
            "timezone": "Asia\/Kolkata",
            "active": 1
        },
        {
            "id": "68f5359b-6984-4658-9c9a-c64b9df54085",
            "name": "test",
            "currency_name": null,
            "currency_symbol": "€",
            "timezone": "Asia\/Kolkata",
            "active": 1
        },
        {
            "id": "6a4d06bb-e462-48dd-ac25-85d975d97ad2",
            "name": "test-location",
            "currency_name": "lek",
            "currency_symbol": "Lek",
            "timezone": "Asia\/Kolkata",
            "active": 1
        },
        {
            "id": "ed33f7ac-c101-4462-9473-bf911505fbcd",
            "name": "cbe1dvgvr",
            "currency_name": "Indian rupee",
            "currency_symbol": "₹",
            "timezone": "Asia\/Kolkata",
            "active": 1
        }
    ]
}
```

### HTTP Request
`GET api/v1/servicelocation`


<!-- END_af8489dfff9eec85451636ea9ea6e1b2 -->

#SignUp-And-Otp-Validation


APIs for User-Management
<!-- START_7fef01e7235c89049ebe3685de4bff17 -->
## Register the user and send welcome email.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/register" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"impedit","company_key":"aut","uuid":"non","email":"architecto","password":"deleniti","oauth_token":"accusamus","password_confirmation":"voluptatem","device_token":"omnis","refferal_code":"quas","login_by":"aut"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/register"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "impedit",
    "company_key": "aut",
    "uuid": "non",
    "email": "architecto",
    "password": "deleniti",
    "oauth_token": "accusamus",
    "password_confirmation": "voluptatem",
    "device_token": "omnis",
    "refferal_code": "quas",
    "login_by": "aut"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "expires_in": 31622400,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjcxNWQ4Yjg5ZjI1ZDVhYzRkNDM0NTYzY2VhNjJmM2Y1ZmYwMDU4YjkwZmJiMGM0YzgxOTliYjkwMWY2Y2NlNjhjMjgyMzNhYWYyOTNhMDQzIn0.eyJhdWQiOiIxIiwianRpIjoiNzE1ZDhiODlmMjVkNWFjNGQ0MzQ1NjNjZWE2MmYzZjVmZjAwNThiOTBmYmIwYzRjODE5OWJiOTAxZjZjY2U2OGMyODIzM2FhZjI5M2EwNDMiLCJpYXQiOjE1ODA5MDI0NDAsIm5iZiI6MTU4MDkwMjQ0MCwiZXhwIjoxNjEyNTI0ODQwLCJzdWIiOiIxMiIsInNjb3BlcyI6W119.jMHG7WfU57-lcPhX0gtFcLbaG_WU1VmAcuw8DDJ_6KRMJJ5LzLtAqcqyZbr8-LaSUO10bfupQYUcYLIMZ3fyB1c99IBOUzoksqbirj7CNZYvv8H5-dbuTlsqXd9e8kjRRFG9tBqmnQ1Bkv0Ctf5rYtbzUBKNc1r7eoHdD715QkEcpVYClkX6McltFGjwuRy-EXutj2eDLQWlSpl-ACa4LxZF41Lv6hHbZd5i6vosNyisWwTuoMsiykikfZyHA8S37F_8XSGafNQVFgUWsef1TDeAFrOSQz12WzguBIpgoXl16e1PwZlseEEW6-sn42ulHjT8aF-vfo_P3K3pVu_XWN3UN0_BgJipVR3rtB0Zi84465r8dTODSKSdQJlMXhZ9CIpWE-gPBZpAknPe9_Zltdp0QZ3qiTA0Mk_LvD2chr6bD37fJDGneFJOasZzMe01aP6JyIt1xlyz-DWzwBnQ2PsO35zDVFd8CHE8uK_S8htJT0j0veqj4eXAAFN_mbMVd0u1tBoxyLxxFlqW2u7IUyvSMiJi-heXH-fACqFfZjGt9iyrAS6_KSuKH-cz8H-oYRT8GF3y9LPLhI96E7JZud55g_PB4AvumT6fP6jrKvCz_quaEzurMPOsSl4f37Yhif1N_3kIenrKCEq6E3ZnuGB1TCkw_Zi4yqwwUdo1W7E",
    "token_type": "Bearer"
}
```

### HTTP Request
`POST api/v1/user/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | name of the user
        `company_key` | string |  optional  | optional company key of demo
        `uuid` | string |  required  | uuid comes from the validate otp's response
        `email` | email |  required  | email of the user
        `password` | password |  required  | password provided user
        `oauth_token` | string |  optional  | optional from social provider
        `password_confirmation` | password |  required  | confirmed password provided user
        `device_token` | string |  required  | device_token of the user
        `refferal_code` | string |  optional  | optional refferal_code of the another user
        `login_by` | string |  required  | from which device the user registered. the input should be 'android',or 'ios'
    
<!-- END_7fef01e7235c89049ebe3685de4bff17 -->

<!-- START_61eb613fa459dd1a3d1a6ceca570a754 -->
## Register the driver and send welcome email.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/driver/register" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"eius","company_key":"voluptate","uuid":"deleniti","email":"velit","password":"ut","password_confirmation":"aut","device_token":"vel","terms_condition":false,"service_location_id":"ratione","refferal_code":"neque","login_by":"iure","is_company_driver":"fugiat","vehicle_type":"praesentium","car_make":"harum","car_model":"consequuntur","car_number":"error"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/register"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "eius",
    "company_key": "voluptate",
    "uuid": "deleniti",
    "email": "velit",
    "password": "ut",
    "password_confirmation": "aut",
    "device_token": "vel",
    "terms_condition": false,
    "service_location_id": "ratione",
    "refferal_code": "neque",
    "login_by": "iure",
    "is_company_driver": "fugiat",
    "vehicle_type": "praesentium",
    "car_make": "harum",
    "car_model": "consequuntur",
    "car_number": "error"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "expires_in": 31622400,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjcxNWQ4Yjg5ZjI1ZDVhYzRkNDM0NTYzY2VhNjJmM2Y1ZmYwMDU4YjkwZmJiMGM0YzgxOTliYjkwMWY2Y2NlNjhjMjgyMzNhYWYyOTNhMDQzIn0.eyJhdWQiOiIxIiwianRpIjoiNzE1ZDhiODlmMjVkNWFjNGQ0MzQ1NjNjZWE2MmYzZjVmZjAwNThiOTBmYmIwYzRjODE5OWJiOTAxZjZjY2U2OGMyODIzM2FhZjI5M2EwNDMiLCJpYXQiOjE1ODA5MDI0NDAsIm5iZiI6MTU4MDkwMjQ0MCwiZXhwIjoxNjEyNTI0ODQwLCJzdWIiOiIxMiIsInNjb3BlcyI6W119.jMHG7WfU57-lcPhX0gtFcLbaG_WU1VmAcuw8DDJ_6KRMJJ5LzLtAqcqyZbr8-LaSUO10bfupQYUcYLIMZ3fyB1c99IBOUzoksqbirj7CNZYvv8H5-dbuTlsqXd9e8kjRRFG9tBqmnQ1Bkv0Ctf5rYtbzUBKNc1r7eoHdD715QkEcpVYClkX6McltFGjwuRy-EXutj2eDLQWlSpl-ACa4LxZF41Lv6hHbZd5i6vosNyisWwTuoMsiykikfZyHA8S37F_8XSGafNQVFgUWsef1TDeAFrOSQz12WzguBIpgoXl16e1PwZlseEEW6-sn42ulHjT8aF-vfo_P3K3pVu_XWN3UN0_BgJipVR3rtB0Zi84465r8dTODSKSdQJlMXhZ9CIpWE-gPBZpAknPe9_Zltdp0QZ3qiTA0Mk_LvD2chr6bD37fJDGneFJOasZzMe01aP6JyIt1xlyz-DWzwBnQ2PsO35zDVFd8CHE8uK_S8htJT0j0veqj4eXAAFN_mbMVd0u1tBoxyLxxFlqW2u7IUyvSMiJi-heXH-fACqFfZjGt9iyrAS6_KSuKH-cz8H-oYRT8GF3y9LPLhI96E7JZud55g_PB4AvumT6fP6jrKvCz_quaEzurMPOsSl4f37Yhif1N_3kIenrKCEq6E3ZnuGB1TCkw_Zi4yqwwUdo1W7E",
    "token_type": "Bearer"
}
```

### HTTP Request
`POST api/v1/driver/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | name of the user
        `company_key` | string |  optional  | optional company key of demo
        `uuid` | string |  required  | from validate otp response
        `email` | email |  required  | email of the user
        `password` | password |  required  | password provided by user
        `password_confirmation` | password |  required  | confirmed password provided user
        `device_token` | string |  required  | device_token of the user
        `terms_condition` | boolean |  required  | it should be 0 or 1
        `service_location_id` | uuid |  required  | service location of the user. it can be listed from service location list apis
        `refferal_code` | string |  optional  | optional refferal_code of the another user
        `login_by` | tinyInt |  required  | from which device the user registered
        `is_company_driver` | tinyInt |  required  | value can be 0 or 1.
        `vehicle_type` | uuid |  required  | vehicle types. listed by types api
        `car_make` | string |  required  | car make of the user
        `car_model` | string |  required  | car model of the user
        `car_number` | string |  required  | car number of the user
    
<!-- END_61eb613fa459dd1a3d1a6ceca570a754 -->

<!-- START_ff99f8f6e7fa37138fa12697cdc0f56d -->
## Send the mobile number verification OTP during registration.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/register/send-otp" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"country":"officiis","mobile":19,"email":"itaque"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/register/send-otp"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "country": "officiis",
    "mobile": 19,
    "email": "itaque"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "uuid": "6ffa38d1-d2ca-434a-8695-701ca22168b1"
    }
}
```

### HTTP Request
`POST api/v1/user/register/send-otp`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `country` | string |  required  | dial_code of the country
        `mobile` | integer |  required  | Mobile of the user
        `email` | string |  required  | Email of the user
    
<!-- END_ff99f8f6e7fa37138fa12697cdc0f56d -->

<!-- START_39946cc6584a80f88f200bc536b20cb0 -->
## Update User Referral

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/update/user/referral" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"refferal_code":"dolorem"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/update/user/referral"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "refferal_code": "dolorem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/update/user/referral`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `refferal_code` | string |  required  | refferal_code of the another user
    
<!-- END_39946cc6584a80f88f200bc536b20cb0 -->

<!-- START_95cc56152073fe9b5b07fcbc49caf1d1 -->
## Update Driver Referral code

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/update/driver/referral" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"refferal_code":"expedita"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/update/driver/referral"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "refferal_code": "expedita"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/update/driver/referral`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `refferal_code` | string |  required  | refferal_code of the another user
    
<!-- END_95cc56152073fe9b5b07fcbc49caf1d1 -->

<!-- START_1eb73ab8423631a8c1cccacf1537d0a0 -->
## Get Referral code

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/get/referral" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/get/referral"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "data": {
        "id": 15,
        "name": "Test Test",
        "last_name": null,
        "username": null,
        "email": "testa@gmail.com",
        "mobile": "9878987812",
        "profile_picture": null,
        "active": 1,
        "email_confirmed": 0,
        "mobile_confirmed": 1,
        "last_known_ip": "::1",
        "last_login_at": "2020-08-05 11:26:35",
        "refferal_code": "RAME123",
        "rating": 5,
        "no_of_ratings": 8,
        "currency_code": "INR",
        "currency_symbol": "$"
    }
}
```

### HTTP Request
`GET api/v1/get/referral`


<!-- END_1eb73ab8423631a8c1cccacf1537d0a0 -->

<!-- START_2df80e5aa5ea9fd621612d35df1b6532 -->
## Validate the mobile number verification OTP during registration.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/register/validate-otp" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"otp":"deserunt","uuid":"quaerat"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/register/validate-otp"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "otp": "deserunt",
    "uuid": "quaerat"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/user/register/validate-otp`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `otp` | string |  required  | Provided otp
        `uuid` | uuid |  required  | uuid comes from sen otp api response
    
<!-- END_2df80e5aa5ea9fd621612d35df1b6532 -->

#Sos-Apis


APIs for Sos
<!-- START_3e0698f546323212af52f5204281e839 -->
## List Sos

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/common/sos/list/id/pariatur" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/sos/list/id/pariatur"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "sos_list",
    "data": [
        {
            "id": "e5962ff4-884c-40e9-b0fe-bc11d85cdcac",
            "name": "dilip",
            "number": "8667241567",
            "user_type": "mobile-users",
            "created_by": 15
        },
        {
            "id": "103f9ea7-ad6c-47b4-bb4b-30d82f301926",
            "name": "police",
            "number": "100",
            "user_type": "admin",
            "created_by": null
        }
    ]
}
```

### HTTP Request
`GET api/v1/common/sos/list/{lat}/{lng}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `lat` |  required  | double  latitude provided by user
    `lng` |  required  | double  longitude provided by user

<!-- END_3e0698f546323212af52f5204281e839 -->

<!-- START_5068d65f8eb1e1cedc8cd5bdaadc7afd -->
## Store Sos

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/common/sos/store" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"name":"facilis","number":"sint"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/sos/store"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "facilis",
    "number": "sint"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "sos_created"
}
```

### HTTP Request
`POST api/v1/common/sos/store`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | name of the user
        `number` | string |  required  | number of the user
    
<!-- END_5068d65f8eb1e1cedc8cd5bdaadc7afd -->

<!-- START_dc0837c0e018ad0afaaa372836a068d5 -->
## Delete Sos

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/common/sos/delete/1" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/sos/delete/1"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "sos_deleted"
}
```

### HTTP Request
`POST api/v1/common/sos/delete/{sos}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | uuid  id of sos

<!-- END_dc0837c0e018ad0afaaa372836a068d5 -->

#Translation

translation api
<!-- START_4b368e0804ff25627d2cce7693626835 -->
## Translation api

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/translation/get" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/translation/get"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "data": {
        "en": {
            "text_enter_social": "or Enter Social Media",
            "text_sign_up": "Sign Up",
            "txt_track_loc": "Tracking Taxi Location",
            "txt_live_ride": "Live tracking for real-time location of your ride",
            "txt_enable_loc": "Enable your location",
            "txt_ride_demand": "Your ride, On demand",
            "txt_fastest_way": "Fastest way to book taxi without the hassle of waiting & haggling for price"
        },
        "ar": {
            "text_enter_social": "آو الدخول عن طريق وسائل التواصل آلآجتماعي",
            "text_sign_up": "تسجيل "
        },
        "es": {
            "text_enter_social": "o Introducir Medios de Comunicación Social",
            "text_sign_up": "Regístrate"
        },
        "ja": {
            "text_enter_social": "またはソーシャルメディアを入力します。",
            "text_sign_up": "サインアップ"
        },
        "ko": {
            "text_enter_social": "또는 소셜 미디어를 입력",
            "text_sign_up": "가입하기"
        },
        "pt": {
            "text_enter_social": "ou Enter Social Media",
            "text_sign_up": "Inscrever-se"
        },
        "zh": {
            "text_enter_social": "或进入社会化媒体",
            "text_sign_up": "注册"
        },
        "fr": {
            "text_enter_social": "ou Entrez les médias sociaux",
            "text_sign_up": "S'inscrire"
        }
    }
}
```

### HTTP Request
`GET api/v1/translation/get`


<!-- END_4b368e0804ff25627d2cce7693626835 -->

#User-Login


<!-- START_e345751f8a6c511d70446cfed908739f -->
## Send the OTP for user login.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/login/send-otp" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"mobile":"unde"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/login/send-otp"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mobile": "unde"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "uuid": "54e4ebe54er5e45re5ber54r5r5rr"
}
```

### HTTP Request
`POST api/v1/user/login/send-otp`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `mobile` | string |  required  | mobile of the user entered
    
<!-- END_e345751f8a6c511d70446cfed908739f -->

<!-- START_7a184547882598fc164c10be7745584b -->
## Login user and respond with access token and refresh token.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/user/login" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"ut","mobile":"ut","password":"sint","device_token":"maiores"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user/login"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "ut",
    "mobile": "ut",
    "password": "sint",
    "device_token": "maiores"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwianRpIjoiMzhlMTY3ZjI3OWQzZTNlYTM4MzlkY2UyZjhiN2I0NDFiMzBkNDRiZWViMDM5Y2ZmMzMyYTZlNzRkNjUwNGI2YTc2",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf787999250966"
}
```

### HTTP Request
`POST api/v1/user/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  optional  | optional email of the user entered
        `mobile` | string |  optional  | optional mobile of the user entered
        `password` | string |  required  | password of the user entered
        `device_token` | string |  required  | fcm_token of the user entered
    
<!-- END_7a184547882598fc164c10be7745584b -->

<!-- START_30589dfe5a25633cc49855fcc531843b -->
## Login driver and respond with access token and refresh token.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/driver/login" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"email":"inventore","mobile":"odio","social_unique_id":"et","password":"nihil","device_token":"autem","apn_token":"dolorem","login_by":"reprehenderit"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/driver/login"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "inventore",
    "mobile": "odio",
    "social_unique_id": "et",
    "password": "nihil",
    "device_token": "autem",
    "apn_token": "dolorem",
    "login_by": "reprehenderit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwianRpIjoiMzhlMTY3ZjI3OWQzZTNlYTM4MzlkY2UyZjhiN2I0NDFiMzBkNDRiZWViMDM5Y2ZmMzMyYTZlNzRkNjUwNGI2YTc2",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf787999250"
}
```

### HTTP Request
`POST api/v1/driver/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  optional  | optional email of the user entered
        `mobile` | string |  optional  | optional mobile of the user entered
        `social_unique_id` | string |  optional  | optional mobile of the user entered
        `password` | string |  optional  | optional password of the user entered
        `device_token` | string |  optional  | optional fcm_token for push notification
        `apn_token` | string |  optional  | optional fcm_token for ios push notification
        `login_by` | string |  required  | i.e android,ios
    
<!-- END_30589dfe5a25633cc49855fcc531843b -->

<!-- START_4d49056edc469970221cae1a09e9aa9a -->
## Login Dispatcher user and respond with access token and refresh token.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/dispatcher/login" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/dispatcher/login"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 1296000,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM4ZTE2N2YyNzlkM2UzZWEzODM5ZGNlMmY4YjdiNDQxYjMwZDQ0YmVlYjAzOWNmZjMzMmE2ZTc0ZDY1MDRiNmE3NjhhZWQzYWU5ZjE5MGUwIn0.eyJhdWQiOiIyIiwiacaP8zkCWTpzh8ZtWBUYVrPkYRWbwz-L5x6dx2d901Aq_7-LwlzPMtP0N93kVfFuLwK2RCzlVtcCTxZaUW9S7x3Y",
    "refresh_token": "def5020045b028faaca5890136e3a8d7c850fb6b95cf2f78698b2356e544ee567cef1efa4099eaea3e3738ba11c9baabb1188a3d49de316e4451f32cdaa6017ebb9ff748fdf43d84b4e796a0456c4125ebaeca7930491fe315e4b86adf7879992509667dd68eacc488bddb2cc005357cdab1da5f0582659eef11e06bf2447c1209f6c17c83453cd6fa6dd6d5d98ff7129a6d3f3509c6c99fba379ea4aee85c0eb89b5f648682484452219d1c592d80c3165657a519f790ba19ad347774c0a199"
}
```

### HTTP Request
`POST api/v1/dispatcher/login`


<!-- END_4d49056edc469970221cae1a09e9aa9a -->

<!-- START_fb2ae43e2e99ff4e90f22ba03801a735 -->
## Logout the user based on their access token.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/logout" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/logout"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/logout`


<!-- END_fb2ae43e2e99ff4e90f22ba03801a735 -->

#User-Management


<!-- START_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->
## Get the current logged in user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/user" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/user"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "data": {
        "id": 6,
        "name": "dilipdk",
        "email": "driver1@gmail.com",
        "mobile": "8667259868",
        "profile_picture": null,
        "active": false,
        "approve": true,
        "available": false,
        "uploaded_document": false,
        "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
        "vehicle_type_id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
        "vehicle_type_name": "Mini",
        "car_make": null,
        "car_model": null,
        "car_make_name": null,
        "car_model_name": null,
        "car_color": null,
        "car_number": null,
        "onTripRequest": {
            "data": {
                "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
                "request_number": "REQ_000002",
                "is_later": 0,
                "user_id": 14,
                "trip_start_time": "19th Apr 11:54 AM",
                "arrived_at": null,
                "accepted_at": null,
                "completed_at": null,
                "is_driver_started": 0,
                "is_driver_arrived": 0,
                "is_trip_start": 0,
                "is_completed": 0,
                "is_cancelled": 0,
                "cancel_method": "0",
                "payment_opt": "1",
                "is_paid": 0,
                "user_rated": 0,
                "driver_rated": 0,
                "unit": "0",
                "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
                "vehicle_type_name": "Mini",
                "pick_lat": 11.0797,
                "pick_lng": 76.9997,
                "drop_lat": 10.99693444,
                "drop_lng": 76.9762592,
                "pick_address": "gandhi puram",
                "drop_address": "srp mills",
                "userDetail": {
                    "data": {
                        "id": 14,
                        "name": "dilipdk",
                        "last_name": null,
                        "username": null,
                        "email": "driver@gmail.com",
                        "mobile": "8667241566",
                        "profile_picture": null,
                        "active": 1,
                        "email_confirmed": 0,
                        "mobile_confirmed": 1,
                        "last_known_ip": "::1",
                        "last_login_at": "2020-04-24 13:08:43"
                    }
                }
            }
        }
    }
}
```
> Example response (200):

```json
{
    "success": true,
    "data": {
        "id": 15,
        "name": "Test Test",
        "last_name": null,
        "username": null,
        "email": "testa@gmail.com",
        "mobile": "9878987812",
        "profile_picture": null,
        "active": 1,
        "email_confirmed": 0,
        "mobile_confirmed": 1,
        "last_known_ip": "::1",
        "last_login_at": "2020-08-05 11:26:35",
        "onTripRequest": {
            "data": {
                "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
                "request_number": "REQ_000002",
                "is_later": 0,
                "user_id": 15,
                "trip_start_time": "19th Apr 11:54 AM",
                "arrived_at": null,
                "accepted_at": null,
                "completed_at": null,
                "is_driver_started": 0,
                "is_driver_arrived": 0,
                "is_trip_start": 0,
                "is_completed": 0,
                "is_cancelled": 0,
                "cancel_method": "0",
                "payment_opt": "1",
                "is_paid": 0,
                "user_rated": 0,
                "driver_rated": 0,
                "unit": "0",
                "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
                "vehicle_type_name": "Mini",
                "pick_lat": 11.0797,
                "pick_lng": 76.9997,
                "drop_lat": 10.99693444,
                "drop_lng": 76.9762592,
                "pick_address": "gandhi puram",
                "drop_address": "srp mills",
                "driverDetail": {
                    "data": {
                        "id": 6,
                        "name": "dilipdk",
                        "email": "driver1@gmail.com",
                        "mobile": "8667259868",
                        "profile_picture": null,
                        "active": false,
                        "approve": true,
                        "available": false,
                        "uploaded_document": false,
                        "service_location_id": "48e861b5-8d4d-4281-807c-1cdd2a5fee3e",
                        "vehicle_type_id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
                        "vehicle_type_name": "Mini",
                        "car_make": null,
                        "car_model": null,
                        "car_make_name": null,
                        "car_model_name": null,
                        "car_color": null,
                        "car_number": null
                    }
                }
            }
        }
    }
}
```

### HTTP Request
`GET api/v1/user`


<!-- END_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->

#User-trips-apis


APIs for User-trips apis
<!-- START_8363b380ed6972df500f7180440c9986 -->
## Calculate an Eta

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/eta" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"pick_lat":22780.27287,"pick_lng":2939.7,"drop_lat":302.71231,"drop_lng":69209571.9114,"vehicle_type":"dolorum","ride_type":"possimus","promo_code":"quidem"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/eta"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pick_lat": 22780.27287,
    "pick_lng": 2939.7,
    "drop_lat": 302.71231,
    "drop_lng": 69209571.9114,
    "vehicle_type": "dolorum",
    "ride_type": "possimus",
    "promo_code": "quidem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "zone_type_id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
        "name": "Mini",
        "distance": 11.87,
        "time": 55,
        "base_distance": 5,
        "base_price": 5,
        "price_per_distance": 5,
        "price_per_time": 5,
        "distance_price": 59.36,
        "time_price": 148.83333333333331,
        "ride_fare": 213.19333333333333,
        "tax_amount": 63.958,
        "tax": "30",
        "total": 277.15133333333335,
        "approximate_value": 1,
        "min_amount": 277.15133333333335,
        "max_amount": 291.00890000000004,
        "currency": null,
        "type_name": "Mini",
        "unit": null,
        "unit_in_words_without_lang": "km",
        "unit_in_words": "km",
        "driver_arival_estimation": "23 min"
    }
}
```

### HTTP Request
`POST api/v1/request/eta`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `pick_lat` | float |  required  | pikup lat of the user
        `pick_lng` | float |  required  | pikup lng of the user
        `drop_lat` | float |  required  | drop lat of the user
        `drop_lng` | float |  required  | drop lng of the user
        `vehicle_type` | string |  required  | id of zone_type_id
        `ride_type` | tinyInteger |  required  | type of ride whther ride now or scheduele trip
        `promo_code` | string |  optional  | optional promo code that the user provided
    
<!-- END_8363b380ed6972df500f7180440c9986 -->

<!-- START_e3089f72b06d42c87de6105a2ddc2123 -->
## Create Request

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/create" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"pick_lat":149942,"pick_lng":625.4706,"drop_lat":199154154.7056266,"drop_lng":26671.5,"drivers":"alias","vehicle_type":"quos","ride_type":"nihil","payment_opt":"aut","pick_address":"quia","drop_address":"ad","is_later":"dicta","trip_start_time":"excepturi","promocode_id":"aut"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/create"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pick_lat": 149942,
    "pick_lng": 625.4706,
    "drop_lat": 199154154.7056266,
    "drop_lng": 26671.5,
    "drivers": "alias",
    "vehicle_type": "quos",
    "ride_type": "nihil",
    "payment_opt": "aut",
    "pick_address": "quia",
    "drop_address": "ad",
    "is_later": "dicta",
    "trip_start_time": "excepturi",
    "promocode_id": "aut"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": "068ecb7a-7198-4322-82b2-28c8e1c90f0a",
        "request_number": "REQ_000002",
        "is_later": 0,
        "user_id": 15,
        "trip_start_time": "5th Aug 09:54 PM",
        "arrived_at": null,
        "accepted_at": null,
        "completed_at": "5th Aug 11:49 PM",
        "is_driver_started": 0,
        "is_driver_arrived": 0,
        "is_trip_start": 0,
        "is_completed": 1,
        "is_cancelled": 0,
        "cancel_method": "0",
        "payment_opt": "1",
        "is_paid": 1,
        "user_rated": 0,
        "driver_rated": 0,
        "unit": "0",
        "zone_type_id": "b0a3a2ce-d248-4767-adea-ae2932731436",
        "vehicle_type_name": "Mini",
        "pick_lat": 11.0797,
        "pick_lng": 76.9997,
        "drop_lat": 11.41157598,
        "drop_lng": 76.77196096,
        "pick_address": "gandhi puram",
        "drop_address": "saravanm patti"
    }
}
```

### HTTP Request
`POST api/v1/request/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `pick_lat` | float |  required  | pikup lat of the user
        `pick_lng` | float |  required  | pikup lng of the user
        `drop_lat` | float |  required  | drop lat of the user
        `drop_lng` | float |  required  | drop lng of the user
        `drivers` | json |  required  | drivers json can be fetch from firebase db
        `vehicle_type` | string |  required  | id of zone_type_id
        `ride_type` | tinyInteger |  required  | type of ride whther ride now or scheduele trip
        `payment_opt` | tinyInteger |  required  | type of ride whther cash or card, wallet('0 => card,1 => cash,2 => wallet)
        `pick_address` | string |  required  | pickup address of the trip request
        `drop_address` | string |  required  | drop address of the trip request
        `is_later` | tinyInteger |  optional  | sometimes it represent the schedule rides param must be 1.
        `trip_start_time` | timestamp |  optional  | sometimes it represent the schedule rides param must be datetime format:Y-m-d H:i:s.
        `promocode_id` | uuid |  optional  | optional id of promo table
    
<!-- END_e3089f72b06d42c87de6105a2ddc2123 -->

<!-- START_d5b7dd7a4719472b4cb8c999ce9d0147 -->
## User Cancel Request

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/v1/request/cancel" \
    -H "Authorization: Bearer: {token}" \
    -H "Content-Type: application/json" \
    -d '{"request_id":"eius","reason":"ut","custom_reason":"officiis"}'

```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/request/cancel"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "request_id": "eius",
    "reason": "ut",
    "custom_reason": "officiis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/v1/request/cancel`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `request_id` | uuid |  required  | id of request
        `reason` | string |  optional  | optional reason provided by user
        `custom_reason` | string |  optional  | optional custom reason provided by user
    
<!-- END_d5b7dd7a4719472b4cb8c999ce9d0147 -->

#Vehicle Management


APIs for vehilce management apis. i.e types,car makes,models apis
<!-- START_7d6cda233d90fef1eaab4f628bfc4749 -->
## Get All Car makes

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/common/car/makes" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/car/makes"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 1,
            "name": "Acura",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 2,
            "name": "Alfa Romeo",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 3,
            "name": "Aston Martin",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 4,
            "name": "Audi",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 5,
            "name": "BMW",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 6,
            "name": "Bentley",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 7,
            "name": "Buick",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 8,
            "name": "Cadillac",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 9,
            "name": "Chevrolet",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 10,
            "name": "Chrysler",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 11,
            "name": "Dodge",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 12,
            "name": "FIAT",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 13,
            "name": "Ferrari",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 14,
            "name": "Fisker",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 15,
            "name": "Ford",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 16,
            "name": "GMC",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 17,
            "name": "HUMMER",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 18,
            "name": "Honda",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 19,
            "name": "Hyundai",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 20,
            "name": "INFINITI",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 21,
            "name": "Isuzu",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 22,
            "name": "Jaguar",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 23,
            "name": "Jeep",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 24,
            "name": "Kia",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 25,
            "name": "Land Rover",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 26,
            "name": "Lexus",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 27,
            "name": "Lincoln",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 28,
            "name": "MINI",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 29,
            "name": "Maserati",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 30,
            "name": "Mazda",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 31,
            "name": "Mercedes-Benz",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 32,
            "name": "Mercury",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 33,
            "name": "Mitsubishi",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 34,
            "name": "Nissan",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 35,
            "name": "Oldsmobile",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 36,
            "name": "Plymouth",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 37,
            "name": "Pontiac",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 38,
            "name": "Porsche",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 39,
            "name": "Ram",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 40,
            "name": "Rolls-Royce",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 41,
            "name": "Saab",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 42,
            "name": "Saturn",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 43,
            "name": "Scion",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 44,
            "name": "Subaru",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 45,
            "name": "Suzuki",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 46,
            "name": "Tesla",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 47,
            "name": "Toyota",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 48,
            "name": "Volkswagen",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 49,
            "name": "Volvo",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        },
        {
            "id": 50,
            "name": "smart",
            "active": 1,
            "created_at": "2020-02-13 07:03:52",
            "updated_at": "2020-02-13 07:03:52"
        }
    ]
}
```

### HTTP Request
`GET api/v1/common/car/makes`


<!-- END_7d6cda233d90fef1eaab4f628bfc4749 -->

<!-- START_1165dedb9927da021d2517dbe471205c -->
## Get Car models by make id

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/common/car/models/alias" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/common/car/models/alias"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": []
}
```

### HTTP Request
`GET api/v1/common/car/models/{make_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `make_id` |  required  | integer, make_id provided by user

<!-- END_1165dedb9927da021d2517dbe471205c -->

<!-- START_0ec9fea9923d1ea0e00f143ba189bd86 -->
## Get Vehcile Types by Service location

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/types/1" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/types/1"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
            "name": "Mini",
            "icon": null,
            "capacity": 4,
            "is_accept_share_ride": 0,
            "active": 1,
            "created_at": "2020-02-13 09:06:39",
            "updated_at": "2020-02-13 09:06:39",
            "deleted_at": null
        }
    ]
}
```

### HTTP Request
`GET api/v1/types/{service_location}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `service_location_id` |  required  | string service location's id

<!-- END_0ec9fea9923d1ea0e00f143ba189bd86 -->

<!-- START_5ffe33acf7351a68f61141bcccfeaa60 -->
## Get all vehicle types by geo location

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/v1/types/accusamus/qui" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/v1/types/accusamus/qui"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": "9ea6f9a0-6fd2-4962-9d81-645e6301096f",
            "name": "Mini",
            "icon": null,
            "capacity": 4,
            "is_accept_share_ride": 0,
            "active": 1,
            "created_at": "2020-02-13 09:06:39",
            "updated_at": "2020-02-13 09:06:39",
            "deleted_at": null
        }
    ]
}
```

### HTTP Request
`GET api/v1/types/{lat}/{lng}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `lat` |  required  | double  latitude provided by user
    `lng` |  required  | double  longitude provided by user

<!-- END_5ffe33acf7351a68f61141bcccfeaa60 -->

#Web-Authentication


APIs for Authentication
<!-- START_806efc7edf80f577102ab9e0651029a5 -->
## Login the Web admin users.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/spa/login" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/spa/login"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/spa/login`


<!-- END_806efc7edf80f577102ab9e0651029a5 -->

<!-- START_71473fc04fd0b4be57bc41bf47623f04 -->
## Login the normal user.

> Example request:

```bash
curl -X POST \
    "http://localhost/future/public/api/spa/user/login" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/spa/user/login"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`POST api/spa/user/login`


<!-- END_71473fc04fd0b4be57bc41bf47623f04 -->

<!-- START_a9cb4b0639caad74b509ee35fb5aed56 -->
## Logout the user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/spa/logout" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/spa/logout"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "success"
}
```

### HTTP Request
`GET api/spa/logout`

`POST api/spa/logout`

`PUT api/spa/logout`

`PATCH api/spa/logout`

`DELETE api/spa/logout`

`OPTIONS api/spa/logout`


<!-- END_a9cb4b0639caad74b509ee35fb5aed56 -->

#Web-Spa-Countries&Timezones


APIs for User-Management
<!-- START_6d72b9e257da7534e94d70f5ae46b700 -->
## Get all the countries.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/spa/common/countries" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/spa/common/countries"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "dial_code": "+93",
            "name": "Afghanistan",
            "code": "AF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AF.png",
            "active": true
        },
        {
            "id": 74,
            "dial_code": "+358",
            "name": "Åland Islands",
            "code": "AX",
            "flag": null,
            "active": true
        },
        {
            "id": 2,
            "dial_code": "+355",
            "name": "Albania",
            "code": "AL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AL.png",
            "active": true
        },
        {
            "id": 4,
            "dial_code": "+213",
            "name": "Algeria",
            "code": "DZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DZ.png",
            "active": true
        },
        {
            "id": 5,
            "dial_code": "+1",
            "name": "American Samoa",
            "code": "AS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AS.png",
            "active": true
        },
        {
            "id": 6,
            "dial_code": "+376",
            "name": "Andorra",
            "code": "AD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AD.png",
            "active": true
        },
        {
            "id": 7,
            "dial_code": "+244",
            "name": "Angola",
            "code": "AO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AO.png",
            "active": true
        },
        {
            "id": 190,
            "dial_code": "+1",
            "name": "Anguilla",
            "code": "AI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AI.png",
            "active": true
        },
        {
            "id": 3,
            "dial_code": "+672",
            "name": "Antarctica",
            "code": "AQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AQ.png",
            "active": true
        },
        {
            "id": 8,
            "dial_code": "+1",
            "name": "Antigua and Barbuda",
            "code": "AG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AG.png",
            "active": true
        },
        {
            "id": 10,
            "dial_code": "+54",
            "name": "Argentina",
            "code": "AR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AR.png",
            "active": true
        },
        {
            "id": 16,
            "dial_code": "+374",
            "name": "Armenia",
            "code": "AM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AM.png",
            "active": true
        },
        {
            "id": 153,
            "dial_code": "+297",
            "name": "Aruba",
            "code": "AW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AW.png",
            "active": true
        },
        {
            "id": 11,
            "dial_code": "+61",
            "name": "Australia",
            "code": "AU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AU.png",
            "active": true
        },
        {
            "id": 12,
            "dial_code": "+43",
            "name": "Austria",
            "code": "AT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AT.png",
            "active": true
        },
        {
            "id": 9,
            "dial_code": "+994",
            "name": "Azerbaijan",
            "code": "AZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AZ.png",
            "active": true
        },
        {
            "id": 13,
            "dial_code": "+1",
            "name": "Bahamas",
            "code": "BS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BS.png",
            "active": true
        },
        {
            "id": 14,
            "dial_code": "+973",
            "name": "Bahrain",
            "code": "BH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BH.png",
            "active": true
        },
        {
            "id": 15,
            "dial_code": "+880",
            "name": "Bangladesh",
            "code": "BD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BD.png",
            "active": true
        },
        {
            "id": 17,
            "dial_code": "+1",
            "name": "Barbados",
            "code": "BB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BB.png",
            "active": true
        },
        {
            "id": 34,
            "dial_code": "+375",
            "name": "Belarus",
            "code": "BY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BY.png",
            "active": true
        },
        {
            "id": 18,
            "dial_code": "+32",
            "name": "Belgium",
            "code": "BE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BE.png",
            "active": true
        },
        {
            "id": 26,
            "dial_code": "+501",
            "name": "Belize",
            "code": "BZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BZ.png",
            "active": true
        },
        {
            "id": 59,
            "dial_code": "+229",
            "name": "Benin",
            "code": "BJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BJ.png",
            "active": true
        },
        {
            "id": 19,
            "dial_code": "+1",
            "name": "Bermuda",
            "code": "BM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BM.png",
            "active": true
        },
        {
            "id": 20,
            "dial_code": "+975",
            "name": "Bhutan",
            "code": "BT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BT.png",
            "active": true
        },
        {
            "id": 21,
            "dial_code": "+591",
            "name": "Bolivia, Plurinational State of",
            "code": "BO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BO.png",
            "active": true
        },
        {
            "id": 155,
            "dial_code": "+599",
            "name": "Bonaire, Sint Eustatius and Saba",
            "code": "BQ",
            "flag": null,
            "active": true
        },
        {
            "id": 22,
            "dial_code": "+387",
            "name": "Bosnia and Herzegovina",
            "code": "BA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BA.png",
            "active": true
        },
        {
            "id": 23,
            "dial_code": "+267",
            "name": "Botswana",
            "code": "BW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BW.png",
            "active": true
        },
        {
            "id": 24,
            "dial_code": "+47",
            "name": "Bouvet Island",
            "code": "BV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BV.png",
            "active": true
        },
        {
            "id": 25,
            "dial_code": "+55",
            "name": "Brazil",
            "code": "BR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BR.png",
            "active": true
        },
        {
            "id": 27,
            "dial_code": "+246",
            "name": "British Indian Ocean Territory",
            "code": "IO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IO.png",
            "active": true
        },
        {
            "id": 30,
            "dial_code": "+673",
            "name": "Brunei Darussalam",
            "code": "BN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BN.png",
            "active": true
        },
        {
            "id": 31,
            "dial_code": "+359",
            "name": "Bulgaria",
            "code": "BG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BG.png",
            "active": true
        },
        {
            "id": 242,
            "dial_code": "+226",
            "name": "Burkina Faso",
            "code": "BF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BF.png",
            "active": true
        },
        {
            "id": 33,
            "dial_code": "+257",
            "name": "Burundi",
            "code": "BI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/BI.png",
            "active": true
        },
        {
            "id": 35,
            "dial_code": "+855",
            "name": "Cambodia",
            "code": "KH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KH.png",
            "active": true
        },
        {
            "id": 36,
            "dial_code": "+237",
            "name": "Cameroon",
            "code": "CM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CM.png",
            "active": true
        },
        {
            "id": 37,
            "dial_code": "+1",
            "name": "Canada",
            "code": "CA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CA.png",
            "active": true
        },
        {
            "id": 38,
            "dial_code": "+238",
            "name": "Cape Verde",
            "code": "CV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CV.png",
            "active": true
        },
        {
            "id": 39,
            "dial_code": "+1",
            "name": "Cayman Islands",
            "code": "KY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KY.png",
            "active": true
        },
        {
            "id": 40,
            "dial_code": "+236",
            "name": "Central African Republic",
            "code": "CF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CF.png",
            "active": true
        },
        {
            "id": 42,
            "dial_code": "+235",
            "name": "Chad",
            "code": "TD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TD.png",
            "active": true
        },
        {
            "id": 43,
            "dial_code": "+56",
            "name": "Chile",
            "code": "CL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CL.png",
            "active": true
        },
        {
            "id": 44,
            "dial_code": "+86",
            "name": "China",
            "code": "CN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CN.png",
            "active": true
        },
        {
            "id": 46,
            "dial_code": "+61",
            "name": "Christmas Island",
            "code": "CX",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CX.png",
            "active": true
        },
        {
            "id": 47,
            "dial_code": "+61",
            "name": "Cocos (Keeling) Islands",
            "code": "CC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CC.png",
            "active": true
        },
        {
            "id": 48,
            "dial_code": "+57",
            "name": "Colombia",
            "code": "CO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CO.png",
            "active": true
        },
        {
            "id": 49,
            "dial_code": "+269",
            "name": "Comoros",
            "code": "KM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KM.png",
            "active": true
        },
        {
            "id": 51,
            "dial_code": "+242",
            "name": "Congo",
            "code": "CG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CG.png",
            "active": true
        },
        {
            "id": 52,
            "dial_code": "+243",
            "name": "Congo, the Democratic Republic of the",
            "code": "CD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CD.png",
            "active": true
        },
        {
            "id": 53,
            "dial_code": "+682",
            "name": "Cook Islands",
            "code": "CK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CK.png",
            "active": true
        },
        {
            "id": 54,
            "dial_code": "+506",
            "name": "Costa Rica",
            "code": "CR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CR.png",
            "active": true
        },
        {
            "id": 110,
            "dial_code": "+225",
            "name": "Côte d'Ivoire",
            "code": "CI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CI.png",
            "active": true
        },
        {
            "id": 55,
            "dial_code": "+385",
            "name": "Croatia",
            "code": "HR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HR.png",
            "active": true
        },
        {
            "id": 56,
            "dial_code": "+53",
            "name": "Cuba",
            "code": "CU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CU.png",
            "active": true
        },
        {
            "id": 152,
            "dial_code": "+599",
            "name": "Curaçao",
            "code": "CW",
            "flag": null,
            "active": true
        },
        {
            "id": 57,
            "dial_code": "+357",
            "name": "Cyprus",
            "code": "CY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CY.png",
            "active": true
        },
        {
            "id": 58,
            "dial_code": "+420",
            "name": "Czech Republic",
            "code": "CZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CZ.png",
            "active": true
        },
        {
            "id": 60,
            "dial_code": "+45",
            "name": "Denmark",
            "code": "DK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DK.png",
            "active": true
        },
        {
            "id": 79,
            "dial_code": "+253",
            "name": "Djibouti",
            "code": "DJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DJ.png",
            "active": true
        },
        {
            "id": 61,
            "dial_code": "+1",
            "name": "Dominica",
            "code": "DM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DM.png",
            "active": true
        },
        {
            "id": 62,
            "dial_code": "+1",
            "name": "Dominican Republic",
            "code": "DO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DO.png",
            "active": true
        },
        {
            "id": 63,
            "dial_code": "+593",
            "name": "Ecuador",
            "code": "EC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EC.png",
            "active": true
        },
        {
            "id": 234,
            "dial_code": "+20",
            "name": "Egypt",
            "code": "EG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EG.png",
            "active": true
        },
        {
            "id": 64,
            "dial_code": "+503",
            "name": "El Salvador",
            "code": "SV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SV.png",
            "active": true
        },
        {
            "id": 65,
            "dial_code": "+240",
            "name": "Equatorial Guinea",
            "code": "GQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GQ.png",
            "active": true
        },
        {
            "id": 67,
            "dial_code": "+291",
            "name": "Eritrea",
            "code": "ER",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ER.png",
            "active": true
        },
        {
            "id": 68,
            "dial_code": "+372",
            "name": "Estonia",
            "code": "EE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EE.png",
            "active": true
        },
        {
            "id": 66,
            "dial_code": "+251",
            "name": "Ethiopia",
            "code": "ET",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ET.png",
            "active": true
        },
        {
            "id": 70,
            "dial_code": "+500",
            "name": "Falkland Islands (Malvinas)",
            "code": "FK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FK.png",
            "active": true
        },
        {
            "id": 69,
            "dial_code": "+298",
            "name": "Faroe Islands",
            "code": "FO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FO.png",
            "active": true
        },
        {
            "id": 72,
            "dial_code": "+679",
            "name": "Fiji",
            "code": "FJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FJ.png",
            "active": true
        },
        {
            "id": 73,
            "dial_code": "+358",
            "name": "Finland",
            "code": "FI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FI.png",
            "active": true
        },
        {
            "id": 75,
            "dial_code": "+33",
            "name": "France",
            "code": "FR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FR.png",
            "active": true
        },
        {
            "id": 76,
            "dial_code": "+594",
            "name": "French Guiana",
            "code": "GF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GF.png",
            "active": true
        },
        {
            "id": 77,
            "dial_code": "+689",
            "name": "French Polynesia",
            "code": "PF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PF.png",
            "active": true
        },
        {
            "id": 78,
            "dial_code": "+33",
            "name": "French Southern Territories",
            "code": "TF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TF.png",
            "active": true
        },
        {
            "id": 80,
            "dial_code": "+241",
            "name": "Gabon",
            "code": "GA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GA.png",
            "active": true
        },
        {
            "id": 82,
            "dial_code": "+220",
            "name": "Gambia",
            "code": "GM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GM.png",
            "active": true
        },
        {
            "id": 81,
            "dial_code": "+995",
            "name": "Georgia",
            "code": "GE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GE.png",
            "active": true
        },
        {
            "id": 84,
            "dial_code": "+49",
            "name": "Germany",
            "code": "DE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/DE.png",
            "active": true
        },
        {
            "id": 85,
            "dial_code": "+233",
            "name": "Ghana",
            "code": "GH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GH.png",
            "active": true
        },
        {
            "id": 86,
            "dial_code": "+350",
            "name": "Gibraltar",
            "code": "GI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GI.png",
            "active": true
        },
        {
            "id": 88,
            "dial_code": "+30",
            "name": "Greece",
            "code": "GR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GR.png",
            "active": true
        },
        {
            "id": 89,
            "dial_code": "+299",
            "name": "Greenland",
            "code": "GL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GL.png",
            "active": true
        },
        {
            "id": 90,
            "dial_code": "+1",
            "name": "Grenada",
            "code": "GD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GD.png",
            "active": true
        },
        {
            "id": 91,
            "dial_code": "+590",
            "name": "Guadeloupe",
            "code": "GP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GP.png",
            "active": true
        },
        {
            "id": 92,
            "dial_code": "+1",
            "name": "Guam",
            "code": "GU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GU.png",
            "active": true
        },
        {
            "id": 93,
            "dial_code": "+502",
            "name": "Guatemala",
            "code": "GT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GT.png",
            "active": true
        },
        {
            "id": 236,
            "dial_code": "+44",
            "name": "Guernsey",
            "code": "GG",
            "flag": null,
            "active": true
        },
        {
            "id": 94,
            "dial_code": "+224",
            "name": "Guinea",
            "code": "GN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GN.png",
            "active": true
        },
        {
            "id": 179,
            "dial_code": "+245",
            "name": "Guinea-Bissau",
            "code": "GW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GW.png",
            "active": true
        },
        {
            "id": 95,
            "dial_code": "+592",
            "name": "Guyana",
            "code": "GY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GY.png",
            "active": true
        },
        {
            "id": 96,
            "dial_code": "+509",
            "name": "Haiti",
            "code": "HT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HT.png",
            "active": true
        },
        {
            "id": 97,
            "dial_code": "+61",
            "name": "Heard Island and McDonald Islands",
            "code": "HM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HM.png",
            "active": true
        },
        {
            "id": 98,
            "dial_code": "+39",
            "name": "Holy See (Vatican City State)",
            "code": "VA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VA.png",
            "active": true
        },
        {
            "id": 99,
            "dial_code": "+504",
            "name": "Honduras",
            "code": "HN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HN.png",
            "active": true
        },
        {
            "id": 100,
            "dial_code": "+852",
            "name": "Hong Kong",
            "code": "HK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HK.png",
            "active": true
        },
        {
            "id": 101,
            "dial_code": "+36",
            "name": "Hungary",
            "code": "HU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/HU.png",
            "active": true
        },
        {
            "id": 102,
            "dial_code": "+354",
            "name": "Iceland",
            "code": "IS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IS.png",
            "active": true
        },
        {
            "id": 103,
            "dial_code": "+91",
            "name": "India",
            "code": "IN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IN.png",
            "active": true
        },
        {
            "id": 104,
            "dial_code": "+62",
            "name": "Indonesia",
            "code": "ID",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ID.png",
            "active": true
        },
        {
            "id": 105,
            "dial_code": "+98",
            "name": "Iran, Islamic Republic of",
            "code": "IR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IR.png",
            "active": true
        },
        {
            "id": 106,
            "dial_code": "+964",
            "name": "Iraq",
            "code": "IQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IQ.png",
            "active": true
        },
        {
            "id": 107,
            "dial_code": "+353",
            "name": "Ireland",
            "code": "IE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IE.png",
            "active": true
        },
        {
            "id": 238,
            "dial_code": "+44",
            "name": "Isle of Man",
            "code": "IM",
            "flag": null,
            "active": true
        },
        {
            "id": 108,
            "dial_code": "+972",
            "name": "Israel",
            "code": "IL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IL.png",
            "active": true
        },
        {
            "id": 109,
            "dial_code": "+39",
            "name": "Italy",
            "code": "IT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/IT.png",
            "active": true
        },
        {
            "id": 111,
            "dial_code": "+1",
            "name": "Jamaica",
            "code": "JM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/JM.png",
            "active": true
        },
        {
            "id": 112,
            "dial_code": "+81",
            "name": "Japan",
            "code": "JP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/JP.png",
            "active": true
        },
        {
            "id": 237,
            "dial_code": "+44",
            "name": "Jersey",
            "code": "JE",
            "flag": null,
            "active": true
        },
        {
            "id": 114,
            "dial_code": "+962",
            "name": "Jordan",
            "code": "JO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/JO.png",
            "active": true
        },
        {
            "id": 113,
            "dial_code": "+7",
            "name": "Kazakhstan",
            "code": "KZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KZ.png",
            "active": true
        },
        {
            "id": 115,
            "dial_code": "+254",
            "name": "Kenya",
            "code": "KE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KE.png",
            "active": true
        },
        {
            "id": 87,
            "dial_code": "+686",
            "name": "Kiribati",
            "code": "KI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KI.png",
            "active": true
        },
        {
            "id": 116,
            "dial_code": "+850",
            "name": "Korea, Democratic People's Republic of",
            "code": "KP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KP.png",
            "active": true
        },
        {
            "id": 117,
            "dial_code": "+82",
            "name": "Korea, Republic of",
            "code": "KR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KR.png",
            "active": true
        },
        {
            "id": 118,
            "dial_code": "+965",
            "name": "Kuwait",
            "code": "KW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KW.png",
            "active": true
        },
        {
            "id": 119,
            "dial_code": "+996",
            "name": "Kyrgyzstan",
            "code": "KG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KG.png",
            "active": true
        },
        {
            "id": 120,
            "dial_code": "+856",
            "name": "Lao People's Democratic Republic",
            "code": "LA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LA.png",
            "active": true
        },
        {
            "id": 123,
            "dial_code": "+371",
            "name": "Latvia",
            "code": "LV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LV.png",
            "active": true
        },
        {
            "id": 121,
            "dial_code": "+961",
            "name": "Lebanon",
            "code": "LB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LB.png",
            "active": true
        },
        {
            "id": 122,
            "dial_code": "+266",
            "name": "Lesotho",
            "code": "LS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LS.png",
            "active": true
        },
        {
            "id": 124,
            "dial_code": "+231",
            "name": "Liberia",
            "code": "LR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LR.png",
            "active": true
        },
        {
            "id": 125,
            "dial_code": "+218",
            "name": "Libya",
            "code": "LY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LY.png",
            "active": true
        },
        {
            "id": 126,
            "dial_code": "+423",
            "name": "Liechtenstein",
            "code": "LI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LI.png",
            "active": true
        },
        {
            "id": 127,
            "dial_code": "+370",
            "name": "Lithuania",
            "code": "LT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LT.png",
            "active": true
        },
        {
            "id": 128,
            "dial_code": "+352",
            "name": "Luxembourg",
            "code": "LU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LU.png",
            "active": true
        },
        {
            "id": 129,
            "dial_code": "+853",
            "name": "Macao",
            "code": "MO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MO.png",
            "active": true
        },
        {
            "id": 233,
            "dial_code": "+389",
            "name": "Macedonia, the former Yugoslav Republic of",
            "code": "MK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MK.png",
            "active": true
        },
        {
            "id": 130,
            "dial_code": "+261",
            "name": "Madagascar",
            "code": "MG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MG.png",
            "active": true
        },
        {
            "id": 131,
            "dial_code": "+265",
            "name": "Malawi",
            "code": "MW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MW.png",
            "active": true
        },
        {
            "id": 132,
            "dial_code": "+60",
            "name": "Malaysia",
            "code": "MY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MY.png",
            "active": true
        },
        {
            "id": 133,
            "dial_code": "+960",
            "name": "Maldives",
            "code": "MV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MV.png",
            "active": true
        },
        {
            "id": 134,
            "dial_code": "+223",
            "name": "Mali",
            "code": "ML",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ML.png",
            "active": true
        },
        {
            "id": 135,
            "dial_code": "+356",
            "name": "Malta",
            "code": "MT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MT.png",
            "active": true
        },
        {
            "id": 168,
            "dial_code": "+692",
            "name": "Marshall Islands",
            "code": "MH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MH.png",
            "active": true
        },
        {
            "id": 136,
            "dial_code": "+596",
            "name": "Martinique",
            "code": "MQ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MQ.png",
            "active": true
        },
        {
            "id": 137,
            "dial_code": "+222",
            "name": "Mauritania",
            "code": "MR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MR.png",
            "active": true
        },
        {
            "id": 138,
            "dial_code": "+230",
            "name": "Mauritius",
            "code": "MU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MU.png",
            "active": true
        },
        {
            "id": 50,
            "dial_code": "+262",
            "name": "Mayotte",
            "code": "YT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/YT.png",
            "active": true
        },
        {
            "id": 139,
            "dial_code": "+52",
            "name": "Mexico",
            "code": "MX",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MX.png",
            "active": true
        },
        {
            "id": 167,
            "dial_code": "+691",
            "name": "Micronesia, Federated States of",
            "code": "FM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/FM.png",
            "active": true
        },
        {
            "id": 142,
            "dial_code": "+373",
            "name": "Moldova, Republic of",
            "code": "MD",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MD.png",
            "active": true
        },
        {
            "id": 140,
            "dial_code": "+377",
            "name": "Monaco",
            "code": "MC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MC.png",
            "active": true
        },
        {
            "id": 141,
            "dial_code": "+976",
            "name": "Mongolia",
            "code": "MN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MN.png",
            "active": true
        },
        {
            "id": 143,
            "dial_code": "+382",
            "name": "Montenegro",
            "code": "ME",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ME.png",
            "active": true
        },
        {
            "id": 144,
            "dial_code": "+1",
            "name": "Montserrat",
            "code": "MS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MS.png",
            "active": true
        },
        {
            "id": 145,
            "dial_code": "+212",
            "name": "Morocco",
            "code": "MA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MA.png",
            "active": true
        },
        {
            "id": 146,
            "dial_code": "+258",
            "name": "Mozambique",
            "code": "MZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MZ.png",
            "active": true
        },
        {
            "id": 32,
            "dial_code": "+95",
            "name": "Myanmar",
            "code": "MM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MM.png",
            "active": true
        },
        {
            "id": 148,
            "dial_code": "+264",
            "name": "Namibia",
            "code": "NA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NA.png",
            "active": true
        },
        {
            "id": 149,
            "dial_code": "+674",
            "name": "Nauru",
            "code": "NR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NR.png",
            "active": true
        },
        {
            "id": 150,
            "dial_code": "+977",
            "name": "Nepal",
            "code": "NP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NP.png",
            "active": true
        },
        {
            "id": 151,
            "dial_code": "+31",
            "name": "Netherlands",
            "code": "NL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NL.png",
            "active": true
        },
        {
            "id": 156,
            "dial_code": "+687",
            "name": "New Caledonia",
            "code": "NC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NC.png",
            "active": true
        },
        {
            "id": 158,
            "dial_code": "+64",
            "name": "New Zealand",
            "code": "NZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NZ.png",
            "active": true
        },
        {
            "id": 159,
            "dial_code": "+505",
            "name": "Nicaragua",
            "code": "NI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NI.png",
            "active": true
        },
        {
            "id": 160,
            "dial_code": "+227",
            "name": "Niger",
            "code": "NE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NE.png",
            "active": true
        },
        {
            "id": 161,
            "dial_code": "+234",
            "name": "Nigeria",
            "code": "NG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NG.png",
            "active": true
        },
        {
            "id": 162,
            "dial_code": "+683",
            "name": "Niue",
            "code": "NU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NU.png",
            "active": true
        },
        {
            "id": 163,
            "dial_code": "+672",
            "name": "Norfolk Island",
            "code": "NF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NF.png",
            "active": true
        },
        {
            "id": 165,
            "dial_code": "+1",
            "name": "Northern Mariana Islands",
            "code": "MP",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/MP.png",
            "active": true
        },
        {
            "id": 164,
            "dial_code": "+47",
            "name": "Norway",
            "code": "NO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/NO.png",
            "active": true
        },
        {
            "id": 147,
            "dial_code": "+968",
            "name": "Oman",
            "code": "OM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/OM.png",
            "active": true
        },
        {
            "id": 170,
            "dial_code": "+92",
            "name": "Pakistan",
            "code": "PK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PK.png",
            "active": true
        },
        {
            "id": 169,
            "dial_code": "+680",
            "name": "Palau",
            "code": "PW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PW.png",
            "active": true
        },
        {
            "id": 83,
            "dial_code": "+970",
            "name": "Palestinian Territory, Occupied",
            "code": "PS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PS.png",
            "active": true
        },
        {
            "id": 171,
            "dial_code": "+507",
            "name": "Panama",
            "code": "PA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PA.png",
            "active": true
        },
        {
            "id": 172,
            "dial_code": "+675",
            "name": "Papua New Guinea",
            "code": "PG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PG.png",
            "active": true
        },
        {
            "id": 173,
            "dial_code": "+595",
            "name": "Paraguay",
            "code": "PY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PY.png",
            "active": true
        },
        {
            "id": 174,
            "dial_code": "+51",
            "name": "Peru",
            "code": "PE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PE.png",
            "active": true
        },
        {
            "id": 175,
            "dial_code": "+63",
            "name": "Philippines",
            "code": "PH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PH.png",
            "active": true
        },
        {
            "id": 176,
            "dial_code": "+649",
            "name": "Pitcairn",
            "code": "PN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PN.png",
            "active": true
        },
        {
            "id": 177,
            "dial_code": "+48",
            "name": "Poland",
            "code": "PL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PL.png",
            "active": true
        },
        {
            "id": 178,
            "dial_code": "+351",
            "name": "Portugal",
            "code": "PT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PT.png",
            "active": true
        },
        {
            "id": 181,
            "dial_code": "+1",
            "name": "Puerto Rico",
            "code": "PR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PR.png",
            "active": true
        },
        {
            "id": 182,
            "dial_code": "+974",
            "name": "Qatar",
            "code": "QA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/QA.png",
            "active": true
        },
        {
            "id": 183,
            "dial_code": "+262",
            "name": "Réunion",
            "code": "RE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RE.png",
            "active": true
        },
        {
            "id": 184,
            "dial_code": "+40",
            "name": "Romania",
            "code": "RO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RO.png",
            "active": true
        },
        {
            "id": 185,
            "dial_code": "+7",
            "name": "Russian Federation",
            "code": "RU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RU.png",
            "active": true
        },
        {
            "id": 186,
            "dial_code": "+250",
            "name": "Rwanda",
            "code": "RW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/RW.png",
            "active": true
        },
        {
            "id": 187,
            "dial_code": "+590",
            "name": "Saint Barthélemy",
            "code": "BL",
            "flag": null,
            "active": true
        },
        {
            "id": 188,
            "dial_code": "+290",
            "name": "Saint Helena, Ascension and Tristan da Cunha",
            "code": "SH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SH.png",
            "active": true
        },
        {
            "id": 189,
            "dial_code": "+1",
            "name": "Saint Kitts and Nevis",
            "code": "KN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/KN.png",
            "active": true
        },
        {
            "id": 191,
            "dial_code": "+1",
            "name": "Saint Lucia",
            "code": "LC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LC.png",
            "active": true
        },
        {
            "id": 192,
            "dial_code": "+590",
            "name": "Saint Martin (French part)",
            "code": "MF",
            "flag": null,
            "active": true
        },
        {
            "id": 193,
            "dial_code": "+508",
            "name": "Saint Pierre and Miquelon",
            "code": "PM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/PM.png",
            "active": true
        },
        {
            "id": 194,
            "dial_code": "+1",
            "name": "Saint Vincent and the Grenadines",
            "code": "VC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VC.png",
            "active": true
        },
        {
            "id": 247,
            "dial_code": "+685",
            "name": "Samoa",
            "code": "WS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/WS.png",
            "active": true
        },
        {
            "id": 195,
            "dial_code": "+378",
            "name": "San Marino",
            "code": "SM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SM.png",
            "active": true
        },
        {
            "id": 196,
            "dial_code": "+239",
            "name": "Sao Tome and Principe",
            "code": "ST",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ST.png",
            "active": true
        },
        {
            "id": 197,
            "dial_code": "+966",
            "name": "Saudi Arabia",
            "code": "SA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SA.png",
            "active": true
        },
        {
            "id": 198,
            "dial_code": "+221",
            "name": "Senegal",
            "code": "SN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SN.png",
            "active": true
        },
        {
            "id": 199,
            "dial_code": "+381",
            "name": "Serbia",
            "code": "RS",
            "flag": null,
            "active": true
        },
        {
            "id": 200,
            "dial_code": "+248",
            "name": "Seychelles",
            "code": "SC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SC.png",
            "active": true
        },
        {
            "id": 201,
            "dial_code": "+232",
            "name": "Sierra Leone",
            "code": "SL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SL.png",
            "active": true
        },
        {
            "id": 202,
            "dial_code": "+65",
            "name": "Singapore",
            "code": "SG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SG.png",
            "active": true
        },
        {
            "id": 154,
            "dial_code": "+721",
            "name": "Sint Maarten (Dutch part)",
            "code": "SX",
            "flag": null,
            "active": true
        },
        {
            "id": 203,
            "dial_code": "+421",
            "name": "Slovakia",
            "code": "SK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SK.png",
            "active": true
        },
        {
            "id": 205,
            "dial_code": "+386",
            "name": "Slovenia",
            "code": "SI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SI.png",
            "active": true
        },
        {
            "id": 28,
            "dial_code": "+677",
            "name": "Solomon Islands",
            "code": "SB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SB.png",
            "active": true
        },
        {
            "id": 206,
            "dial_code": "+252",
            "name": "Somalia",
            "code": "SO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SO.png",
            "active": true
        },
        {
            "id": 207,
            "dial_code": "+27",
            "name": "South Africa",
            "code": "ZA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ZA.png",
            "active": true
        },
        {
            "id": 71,
            "dial_code": "+44",
            "name": "South Georgia and the South Sandwich Islands",
            "code": "GS",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GS.png",
            "active": true
        },
        {
            "id": 210,
            "dial_code": "+211",
            "name": "South Sudan",
            "code": "SS",
            "flag": null,
            "active": true
        },
        {
            "id": 209,
            "dial_code": "+34",
            "name": "Spain",
            "code": "ES",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ES.png",
            "active": true
        },
        {
            "id": 41,
            "dial_code": "+94",
            "name": "Sri Lanka",
            "code": "LK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/LK.png",
            "active": true
        },
        {
            "id": 211,
            "dial_code": "+249",
            "name": "Sudan",
            "code": "SD",
            "flag": null,
            "active": true
        },
        {
            "id": 213,
            "dial_code": "+597",
            "name": "Suriname",
            "code": "SR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SR.png",
            "active": true
        },
        {
            "id": 214,
            "dial_code": "+47",
            "name": "Svalbard and Jan Mayen",
            "code": "SJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SJ.png",
            "active": true
        },
        {
            "id": 215,
            "dial_code": "+268",
            "name": "Swaziland",
            "code": "SZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SZ.png",
            "active": true
        },
        {
            "id": 216,
            "dial_code": "+46",
            "name": "Sweden",
            "code": "SE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SE.png",
            "active": true
        },
        {
            "id": 217,
            "dial_code": "+41",
            "name": "Switzerland",
            "code": "CH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/CH.png",
            "active": true
        },
        {
            "id": 218,
            "dial_code": "+963",
            "name": "Syrian Arab Republic",
            "code": "SY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/SY.png",
            "active": true
        },
        {
            "id": 45,
            "dial_code": "+886",
            "name": "Taiwan, Province of China",
            "code": "TW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TW.png",
            "active": true
        },
        {
            "id": 219,
            "dial_code": "+992",
            "name": "Tajikistan",
            "code": "TJ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TJ.png",
            "active": true
        },
        {
            "id": 239,
            "dial_code": "+255",
            "name": "Tanzania, United Republic of",
            "code": "TZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TZ.png",
            "active": true
        },
        {
            "id": 220,
            "dial_code": "+66",
            "name": "Thailand",
            "code": "TH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TH.png",
            "active": true
        },
        {
            "id": 180,
            "dial_code": "+670",
            "name": "Timor-Leste",
            "code": "TL",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TL.png",
            "active": true
        },
        {
            "id": 221,
            "dial_code": "+228",
            "name": "Togo",
            "code": "TG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TG.png",
            "active": true
        },
        {
            "id": 222,
            "dial_code": "+690",
            "name": "Tokelau",
            "code": "TK",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TK.png",
            "active": true
        },
        {
            "id": 223,
            "dial_code": "+676",
            "name": "Tonga",
            "code": "TO",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TO.png",
            "active": true
        },
        {
            "id": 224,
            "dial_code": "+1",
            "name": "Trinidad and Tobago",
            "code": "TT",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TT.png",
            "active": true
        },
        {
            "id": 226,
            "dial_code": "+216",
            "name": "Tunisia",
            "code": "TN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TN.png",
            "active": true
        },
        {
            "id": 227,
            "dial_code": "+90",
            "name": "Turkey",
            "code": "TR",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TR.png",
            "active": true
        },
        {
            "id": 228,
            "dial_code": "+993",
            "name": "Turkmenistan",
            "code": "TM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TM.png",
            "active": true
        },
        {
            "id": 229,
            "dial_code": "+1",
            "name": "Turks and Caicos Islands",
            "code": "TC",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TC.png",
            "active": true
        },
        {
            "id": 230,
            "dial_code": "+688",
            "name": "Tuvalu",
            "code": "TV",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/TV.png",
            "active": true
        },
        {
            "id": 231,
            "dial_code": "+256",
            "name": "Uganda",
            "code": "UG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UG.png",
            "active": true
        },
        {
            "id": 232,
            "dial_code": "+380",
            "name": "Ukraine",
            "code": "UA",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UA.png",
            "active": true
        },
        {
            "id": 225,
            "dial_code": "+971",
            "name": "United Arab Emirates",
            "code": "AE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/AE.png",
            "active": true
        },
        {
            "id": 235,
            "dial_code": "+44",
            "name": "United Kingdom",
            "code": "GB",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/GB.png",
            "active": true
        },
        {
            "id": 240,
            "dial_code": "+1",
            "name": "United States",
            "code": "US",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/US.png",
            "active": true
        },
        {
            "id": 166,
            "dial_code": "+1",
            "name": "United States Minor Outlying Islands",
            "code": "UM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UM.png",
            "active": true
        },
        {
            "id": 243,
            "dial_code": "+598",
            "name": "Uruguay",
            "code": "UY",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UY.png",
            "active": true
        },
        {
            "id": 244,
            "dial_code": "+998",
            "name": "Uzbekistan",
            "code": "UZ",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/UZ.png",
            "active": true
        },
        {
            "id": 157,
            "dial_code": "+678",
            "name": "Vanuatu",
            "code": "VU",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VU.png",
            "active": true
        },
        {
            "id": 245,
            "dial_code": "+58",
            "name": "Venezuela, Bolivarian Republic of",
            "code": "VE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VE.png",
            "active": true
        },
        {
            "id": 204,
            "dial_code": "+84",
            "name": "Viet Nam",
            "code": "VN",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VN.png",
            "active": true
        },
        {
            "id": 29,
            "dial_code": "+1",
            "name": "Virgin Islands, British",
            "code": "VG",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VG.png",
            "active": true
        },
        {
            "id": 241,
            "dial_code": "+1",
            "name": "Virgin Islands, U.S.",
            "code": "VI",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/VI.png",
            "active": true
        },
        {
            "id": 246,
            "dial_code": "+681",
            "name": "Wallis and Futuna",
            "code": "WF",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/WF.png",
            "active": true
        },
        {
            "id": 212,
            "dial_code": "+212",
            "name": "Western Sahara",
            "code": "EH",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/EH.png",
            "active": true
        },
        {
            "id": 248,
            "dial_code": "+967",
            "name": "Yemen",
            "code": "YE",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/YE.png",
            "active": true
        },
        {
            "id": 249,
            "dial_code": "+260",
            "name": "Zambia",
            "code": "ZM",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ZM.png",
            "active": true
        },
        {
            "id": 208,
            "dial_code": "+263",
            "name": "Zimbabwe",
            "code": "ZW",
            "flag": "http:\/\/localhost\/future\/public\/storage\/uploads\/country\/flags\/ZW.png",
            "active": true
        }
    ]
}
```

### HTTP Request
`GET api/spa/common/countries`


<!-- END_6d72b9e257da7534e94d70f5ae46b700 -->

<!-- START_47dd2d8421359d6b3fc0be8bb3466f75 -->
## Get all the timezone.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/future/public/api/spa/common/timezones" \
    -H "Authorization: Bearer: {token}"
```

```javascript
const url = new URL(
    "http://localhost/future/public/api/spa/common/timezones"
);

let headers = {
    "Authorization": "Bearer: {token}",
    "Accept": "application/json",
    "Content-Type": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "data": [
        {
            "id": "b7533180-413b-4f76-b1f4-43f67f755b01",
            "name": "Kolkata",
            "abbr": null,
            "offset": null,
            "isdst": null,
            "text": null,
            "utc": null
        }
    ]
}
```

### HTTP Request
`GET api/spa/common/timezones`


<!-- END_47dd2d8421359d6b3fc0be8bb3466f75 -->


