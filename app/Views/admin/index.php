<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="row mt-4">
    <div class="col-12 mb-4">
        <div class="card bg-yellow-100 border-0 shadow">
            <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                <div class="d-block mb-3 mb-sm-0">
                    <div class="fs-5 fw-normal mb-2">Sales Value</div>
                    <h2 class="fs-3 fw-extrabold">$10,567</h2>
                    <div class="small mt-2">
                        <span class="fw-normal me-2">Yesterday</span>
                        <span class="fas fa-angle-up text-success"></span>
                        <span class="text-success fw-bold">10.57%</span>
                    </div>
                </div>
                <div class="d-flex ms-auto">
                    <a href="#" class="btn btn-secondary text-dark btn-sm me-2">Month</a>
                    <a href="#" class="btn btn-dark btn-sm me-3">Week</a>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="ct-chart-sales-value ct-double-octave ct-series-g">
                    <div class="chartist-tooltip" style="top: 99.7031px; left: 683px;"></div><svg
                        xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                        class="ct-chart-line" style="width: 100%; height: 100%;">
                        <g class="ct-grids">
                            <line x1="50" x2="50" y1="15" y2="149.25" class="ct-grid ct-horizontal"></line>
                            <line x1="162" x2="162" y1="15" y2="149.25" class="ct-grid ct-horizontal"></line>
                            <line x1="274" x2="274" y1="15" y2="149.25" class="ct-grid ct-horizontal"></line>
                            <line x1="386" x2="386" y1="15" y2="149.25" class="ct-grid ct-horizontal"></line>
                            <line x1="498" x2="498" y1="15" y2="149.25" class="ct-grid ct-horizontal"></line>
                            <line x1="610" x2="610" y1="15" y2="149.25" class="ct-grid ct-horizontal"></line>
                            <line x1="722" x2="722" y1="15" y2="149.25" class="ct-grid ct-horizontal"></line>
                        </g>
                        <g>
                            <g class="ct-series ct-series-a">
                                <path
                                    d="M50,149.25L50,149.25C87.333,144.775,124.667,141.792,162,135.825C199.333,129.858,236.667,114.942,274,108.975C311.333,103.008,348.667,102.71,386,95.55C423.333,88.39,460.667,41.85,498,41.85C535.333,41.85,572.667,68.7,610,68.7C647.333,68.7,684.667,32.9,722,15L722,149.25Z"
                                    class="ct-area"></path>
                                <path
                                    d="M50,149.25C87.333,144.775,124.667,141.792,162,135.825C199.333,129.858,236.667,114.942,274,108.975C311.333,103.008,348.667,102.71,386,95.55C423.333,88.39,460.667,41.85,498,41.85C535.333,41.85,572.667,68.7,610,68.7C647.333,68.7,684.667,32.9,722,15"
                                    class="ct-line"></path>
                                <line x1="50" y1="149.25" x2="50.01" y2="149.25" class="ct-point" ct:value="0"></line>
                                <line x1="162" y1="135.825" x2="162.01" y2="135.825" class="ct-point" ct:value="10">
                                </line>
                                <line x1="274" y1="108.975" x2="274.01" y2="108.975" class="ct-point" ct:value="30">
                                </line>
                                <line x1="386" y1="95.55" x2="386.01" y2="95.55" class="ct-point" ct:value="40"></line>
                                <line x1="498" y1="41.849999999999994" x2="498.01" y2="41.849999999999994"
                                    class="ct-point" ct:value="80"></line>
                                <line x1="610" y1="68.7" x2="610.01" y2="68.7" class="ct-point" ct:value="60"></line>
                                <line x1="722" y1="15" x2="722.01" y2="15" class="ct-point" ct:value="100"></line>
                            </g>
                        </g>
                        <g class="ct-labels">
                            <foreignObject style="overflow: visible;" x="50" y="154.25" width="112" height="20"><span
                                    class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                    style="width: 112px; height: 20px;">Mon</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="162" y="154.25" width="112" height="20"><span
                                    class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                    style="width: 112px; height: 20px;">Tue</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="274" y="154.25" width="112" height="20"><span
                                    class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                    style="width: 112px; height: 20px;">Wed</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="386" y="154.25" width="112" height="20"><span
                                    class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                    style="width: 112px; height: 20px;">Thu</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="498" y="154.25" width="112" height="20"><span
                                    class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                    style="width: 112px; height: 20px;">Fri</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="610" y="154.25" width="112" height="20"><span
                                    class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                    style="width: 112px; height: 20px;">Sat</span></foreignObject>
                            <foreignObject style="overflow: visible;" x="722" y="154.25" width="30" height="20"><span
                                    class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/"
                                    style="width: 30px; height: 20px;">Sun</span></foreignObject>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>