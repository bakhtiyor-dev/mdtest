<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link rel="shortcut icon" href="{{url('images/logo.png')}}" type="image/png">

        {{-- Include core + vendor Styles --}}
        @include('client/panels/styles')

    </head>

@extends('client.layouts.verticalLayoutMaster')

