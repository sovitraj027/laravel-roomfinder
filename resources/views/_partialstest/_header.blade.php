<!doctype html>
<html lang="en">


<link href="{{ asset('css/main.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
{{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
<!-- datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/cr-1.5.0/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

{{--Toastr--}}
<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

{{--changes made for pusher--}}
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet'/>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta title="Code Alchemy">
    <meta name="description" content="Code Alchemy">
    <meta name="keywords" content="Code Alchemy Site">
    <link rel="shortcut icon" href="{{ asset('images/logo_ico.png') }}" type="image/x-icon" style="height: 50px;">
    <link rel="icon" href="{{ asset('images/logo_ico.png') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <title>Room Finder</title>
</head>
