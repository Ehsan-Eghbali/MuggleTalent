@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/teams.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-users page-icon"></i> مدیریت تیم‌ها</h1>
</div>

<div class="teams-container">
    {{-- ستون سمت راست: فرم افزودن تیم --}}
    <div class="add-team-form">
        <div class="card">
            <div class="card-header">افزودن تیم جدید</div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="team_name">نام تیم</label>
                        <input type="text" id="team_name" name="team_name" placeholder="مثال: تیم محصول" required>
                    </div>
                    <button type="submit" class="btn-primary full-width">
                        <i class="fas fa-plus-circle"></i> افزودن
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ستون سمت چپ: لیست تیم‌ها --}}
    <div class="teams-list">
        <div class="card">
            <div class="card-header">تیم‌های تعریف شده</div>
            <div class="card-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>نام تیم</th>
                            <th>اقدامات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                        <tr>
                            <td>{{ $team['name'] }}</td>
                            <td>
                                <a href="#" title="ویرایش" class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                <a href="#" title="حذف" class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection