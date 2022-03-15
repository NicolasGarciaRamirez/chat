<head-profile :user="{{ $user }}" :user_autenticate="{{\Auth::check() ? \Auth::user()->load('payment_methods','payment_ip_data') : '{}' }}" ref="Profile"/>
