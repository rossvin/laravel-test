@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ваш кошелек, {{ $data_user }}</div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Пополнить баланс</div>
                <div class="card-body">
                    <form method="POST" action="">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <label for="exampleInputEmail1">Сумма</label>
                        <input name="sum-bal" class="form-control">
                            <input type="hidden" name="sum-bal-check" class="form-control" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Пополнить</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ваш текущий баланс - {{ $data_balance }}</div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вклад на депозит</div>
                <div class="card-body">
                    <form method="POST" action="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Сумма</label>
                            <input name="sum-dep" class="form-control">
                            <input type="hidden" name="sum-dep-check" class="form-control" value="1">
                        </div>
                        <button type="submit" class="btn btn-primary">Вложить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Депозиты</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Сумма вклада</th>
                            <th>Процент</th>
                            <th>Количество текущих начислений</th>
                            <th>Сумма начислений</th>
                            <th>Статус депозита</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data_deposits as $data)
                        <tr>
                            <th scope="row">{{ $data['id'] }}</th>
                            <td>{{ $data['invested'] }}</td>
                            <td>{{ $data['percent'] }}</td>
                            <td>{{ $data['duration'] }}</td>
                            <td>{{ $data['accrue_times'] }}</td>
                            @if ($data['active'] === 1)
                            <td>Активный</td>
                            @else
                            <td>Неактивный</td>
                            @endif
                            <td>{{ $data['created_at'] }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Транзакции</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Тип</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data_transaction as $data)
                        <tr>
                            <th scope="row">{{ $data['id'] }}</th>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['amount'] }}</td>
                            <td>{{ $data['created_at'] }}</td>
                        </tr>
                        @endforeach
                         </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
