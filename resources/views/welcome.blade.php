@extends('layouts.app')

@include('components.event.detail', [
    'event' => $event,
    'topics' => $topics
])
