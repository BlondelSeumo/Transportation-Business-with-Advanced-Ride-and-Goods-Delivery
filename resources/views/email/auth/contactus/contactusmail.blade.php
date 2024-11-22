@extends('email.layout')

@section('content')
 <body>
    <section class="contact-main-div">
        <div class="contact-us-content">
            <h2 style="text-align: center;font-weight: 400;">A New Request from {{ ucfirst($data['name']) }}</h2>
            <table class="contact-table">
                <tbody>
                    <tr>
                        <td>
                          @lang('view_pages.name')
                        </td>
                        <td>
                            {{ $data['name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                           @lang('view_pages.email')
                        </td>
                        <td>
                            {{ $data['email'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @lang('view_pages.phone')
                        </td>
                        <td>
                            {{ $data['mobile'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                          @lang('view_pages.message')
                        </td>
                        <td>
                            {{ $data['message'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>
@endsection