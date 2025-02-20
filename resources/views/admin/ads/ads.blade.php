@extends('layouts.dashboard')

@section('title', __('auth.voucher_confirmation'))

@section('content')
    <div class="container-fixed">
        <div class="mb-4">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-semibold">Ads</h1>
                <a href="{{ route('ads.create') }}" class="btn btn-primary">Добавить</a>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            @if (Session::get('error'))
                <div class="alert alert-info w-100">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
    </div>

    <div class="container-fixed">
        <div class="card">
            <div class="card-table scrollable-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Названия</th>
                            <th class="text-center">Статус</th>
                            <th class="text-center">Дата начало</th>
                            <th class="text-center">Дата окончания</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($ads))
                            @foreach ($ads as $ad)
                                <tr>
                                    <td>{{ $ad->id }}</td>
                                    <td>{{ $ad->getName() }}</td>
                                    <td class="text-center">
                                        @switch($ad->status)
                                            @case(0)
                                                Остановлен
                                            @break

                                            @case(1)
                                                Актив
                                            @break
                                        @endswitch
                                    </td>
                                    <td class="text-center">{{ date('d.m.Y, H:i', strtotime($ad->date_start)) }}</td>
                                    <td class="text-center">{{ date('d.m.Y, H:i', strtotime($ad->date_end)) }}</td>
                                    <td class="text-end">
                                        @switch($ad->status)
                                            @case(0)
                                                <a href="{{ route('admin.ads.status', ['active', $ad->id]) }}"
                                                    onclick="return confirm('Вы действительно хотите активировать? ')"
                                                    class="btn btn-success btn-sm">Актировать</a>
                                            @break

                                            @case(1)
                                                <a href="{{ route('admin.ads.status', ['stop', $ad->id]) }}"
                                                    onclick="return confirm('Вы действительно хотите остановить? ')"
                                                    class="btn btn-secondary btn-sm">Остановить</a>
                                            @break
                                        @endswitch
                                        {{-- <a href="{{ route('admin.ads', $ad->id) }}" class="btn btn-primary btn-sm"><i
                                            class="fas fa-eye"></i></a> --}}
                                        <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-primary btn-sm">
                                            <i class="ki-filled ki-notepad-edit"></i>
                                        </a>
                                        <form action="{{ route('ads.destroy', $ad->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Вы действительно хотите удалить ?')">
                                                <i class="ki-filled ki-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="float-left">
        {{ $ads->links() }}
    </div>
@endsection
