@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Application #{{ $application->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.applications.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $application->name) }}" required />
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email', $application->email) }}" />
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input name="phone" class="form-control" value="{{ old('phone', $application->phone) }}" />
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="">--</option>
                <option value="male" {{ old('gender', $application->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $application->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $application->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label>Spouse Type</label>
            <select name="spouse_type" class="form-control">
                <option value="none" {{ old('spouse_type', $application->spouse_type) == 'none' ? 'selected' : '' }}>None</option>
                <option value="husband" {{ old('spouse_type', $application->spouse_type) == 'husband' ? 'selected' : '' }}>Husband</option>
                <option value="wife" {{ old('spouse_type', $application->spouse_type) == 'wife' ? 'selected' : '' }}>Wife</option>
            </select>
        </div>

        <div class="form-group">
            <label>Member Type</label>
            <select name="member_type" class="form-control">
                <option value="guest" {{ old('member_type', $application->member_type) == 'guest' ? 'selected' : '' }}>Guest</option>
                <option value="ex_student" {{ old('member_type', $application->member_type) == 'ex_student' ? 'selected' : '' }}>Ex Student</option>
                <option value="running_student" {{ old('member_type', $application->member_type) == 'running_student' ? 'selected' : '' }}>Running Student</option>
            </select>
        </div>

        <div class="form-group">
            <label>T-shirt Size</label>
            <input name="tshirt_size" class="form-control" value="{{ old('tshirt_size', $application->tshirt_size) }}" />
        </div>

        <div class="form-group">
            <label>Number of Children</label>
            <input name="number_of_children" type="number" class="form-control" value="{{ old('number_of_children', $application->number_of_children) }}" />
        </div>

        <div class="form-group">
            <label>Payment Method</label>
            <input name="payment_method" class="form-control" value="{{ old('payment_method', $application->payment_method) }}" />
        </div>

        <div class="form-group">
            <label>Donation Amount</label>
            <input name="donation_amount" type="number" class="form-control" value="{{ old('donation_amount', $application->donation_amount) }}" />
        </div>

        <div class="form-group">
            <label>Transaction Number</label>
            <input name="transaction_number" class="form-control" value="{{ old('transaction_number', $application->transaction_number) }}" />
        </div>

        <div class="form-group">
            <label>Graduation Year</label>
            <input name="graduation_year" type="number" class="form-control" value="{{ old('graduation_year', $application->graduation_year) }}" />
        </div>

        <div class="form-group">
            <label>Message</label>
            <textarea name="message" class="form-control">{{ old('message', $application->message) }}</textarea>
        </div>

        <button class="btn btn-primary">Save changes</button>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
