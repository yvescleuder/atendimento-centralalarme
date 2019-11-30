@extends('layout.app')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                    <h5 class="text-white op-7 mb-2">Sistema para controle planilhas de atendimentos e vendas</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Estatísticas de Atendimento</div>
                        <div class="card-category">Informações gerais de atendimento do sistema</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="attendances-today"></div>
                                <h6 class="fw-bold mt-3 mb-0">Novos atendimentos de hoje</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="attendances-all"></div>
                                <h6 class="fw-bold mt-3 mb-0">Total de atendimentos</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Acrescentar informação aqui --}}
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Atendimentos este ano ({{ now()->year }})</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Chart JS -->
    <script src="/js/plugin/chart.js/chart.min.js"></script>
    <!-- Chart Circle -->
    <script src="/js/plugin/chart-circle/circles.min.js"></script>
    <script src="/js/modules/dashboard.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            centralalarme.dasboard.statisticsChart({!! json_encode($attendances) !!});
            centralalarme.dasboard.chart('attendances-today', "{{ $today->cont }}", ['#f1f1f1', '#FF9E27']);
            centralalarme.dasboard.chart('attendances-all', "{{ $all->cont }}", ['#f1f1f1', '#F25961']);
            //centralalarme.dasboard.chart('circles-2', "1", ['#f1f1f1', '#2BB930']);
        });
    </script>
@endsection
