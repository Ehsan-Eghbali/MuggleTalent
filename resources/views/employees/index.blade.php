@extends('master.index')

@section('content')

    <div class="container mt-4">
        <h2>لیست پرسنل</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">افزودن پرسنل جدید</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>شماره پرسنلی</th>
                <th>نام کامل</th>
                <th>سمت</th>
                <th>واحد</th>
                <th>ایمیل سازمانی</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->employee_number }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->department }}</td>
                    <td>{{ $employee->organization_email }}</td>
                    <td>
                        <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">نمایش</a>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-primary">ویرایش</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف مطمئن هستید؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">هیچ پرسنلی یافت نشد.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
