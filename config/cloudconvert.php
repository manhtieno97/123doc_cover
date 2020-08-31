<?php
return [

    /**
     * You can generate API keys here: https://cloudconvert.com/dashboard/api/v2/keys.
     */

    'api_key' => env('CLOUDCONVERT_API_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOWY1OWI1OGQ0MWYyMDlhZTc4YjlmMGM2NTQ4OTY5MjFlZjJkMWVmZDJlOTBkYTM2OTc2MWQwZDIwNjQwZTQ2M2Y1Y2FhOTY3OWY4NTEyY2IiLCJpYXQiOjE1OTg1ODQzNjcsIm5iZiI6MTU5ODU4NDM2NywiZXhwIjo0NzU0MjU3OTY3LCJzdWIiOiI0NDQ4MTI3MSIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsIndlYmhvb2sucmVhZCIsIndlYmhvb2sud3JpdGUiLCJwcmVzZXQucmVhZCIsInByZXNldC53cml0ZSJdfQ.TkDZy6uvEaDXnOtEIpJ4yURBNrCbHZ7OnNdSuSXwYWYhS1zcn_3mvONo6kbFuZJYjBSrxsGK1IWZ0Q6I6PGbuydLJR6Q7hWKYZzW0gYrwx_6XHfEWU8N8DbXCzDNvarAkjBeHd_N-bZNg5snThO4Ixvk3hwDI2FxDwmxJ8tdl7jLf4WxnxPBGOyhXSlX6dfW7R7fCgeBBiory_-M--oL8Ka1CVadicItknSdMEdclBL_jNvOU6Qmw3TTvKIa2kYURIxOQP2-JrJs9PsWpT6DzHC-v3eOQo-yeVyUTk8nWX5FT-LS8MOpxvfJWB62mfONL4Ekx3egaFN_oRmfblFT5aMolaF-jUPcfMq-sxyMgbfdPBtg1hqTJ_QyO9hbx50ClRkeuIMwO1lu4dykk1y13sM5JbbU0lCtcjl56vS-vk2v8DIXK96cvE432uHME-8SlLsQdvLdUhlxlXbZIOOpSmyeNUTbK2YB_YTPPe54d2CrcTmMS0d62kI4nb0sqPEn_lB-YZxXIRENhOwXdjtzPt33EvSAiC6czBVYZyVWo1mFmusQYUAS1_VsCT3D43hWGQoRH-mQb_aaTR9vflgrEMSQ0E9qM3pFq0cexElYeYg-CFXUmOwBQ5b4VBfcg8Rn-DMeJIFviJmvGdiMoiUmR957YkZPRRkZ5efl8bNFu1A'),

    /**
     * Use the CloudConvert Sanbox API (Defaults to false, which enables the Production API).
     */
    'sandbox' => env('CLOUDCONVERT_SANDBOX', false),

    /**
     * You can find the secret used at the webhook settings: https://cloudconvert.com/dashboard/api/v2/webhooks
     */
    'webhook_signing_secret' => env('CLOUDCONVERT_WEBHOOK_SIGNING_SECRET', '')

];
