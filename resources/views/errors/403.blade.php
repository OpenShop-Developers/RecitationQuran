@extends('errors.illustrated-layout')
@section('title', __('ممنوع !'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'عفوا ليس لديك الصلاحيه للقيام بهذه العمليه'))
