<div class="dashboard-page">

    <!-- HERO -->
    <div class="hero-card mb-4">

        <div class="hero-content">

            <div>

                <div class="hero-badge">
                    <i class="bi bi-stars"></i>
                    Analytics Overview
                </div>

                <h1>
                    Welcome Back,
                    <?= $this->session->userdata('name') ?>
                </h1>

                <p>
                    Monitor your perfume store performance and track business growth.
                </p>

                <div class="hero-revenue">

                    <small>Total Revenue</small>

                    <h2 id="total_revenue">
                        Rp 0
                    </h2>

                </div>

            </div>

        </div>

    </div>


    <!-- STATS -->
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="stats-card users">

                <div class="stats-icon">
                    <i class="bi bi-people"></i>
                </div>

                <div>

                    <span>Total Users</span>

                    <h3 id="total_users">0</h3>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stats-card products">

                <div class="stats-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>

                    <span>Total Products</span>

                    <h3 id="total_products">0</h3>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stats-card orders">

                <div class="stats-icon">
                    <i class="bi bi-bag-check"></i>
                </div>

                <div>

                    <span>Total Orders</span>

                    <h3 id="total_orders">0</h3>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="stats-card brands">

                <div class="stats-icon">
                    <i class="bi bi-award"></i>
                </div>

                <div>

                    <span>Total Brands</span>

                    <h3 id="total_brands">0</h3>

                </div>

            </div>

        </div>

    </div>



    <div class="row g-4">

        <!-- CHART -->
        <div class="col-lg-8">

            <div class="dashboard-card">

                <div class="dashboard-title">

                    <div>

                        <h5>Business Analytics</h5>

                        <span>Overview statistics</span>

                    </div>

                </div>

                <div class="p-4">

                    <canvas id="orderChart"></canvas>

                </div>

            </div>

        </div>



        <!-- QUICK INFO -->
        <div class="col-lg-4">

            <div class="dashboard-card h-100">

                <div class="dashboard-title">

                    <div>

                        <h5>Store Information</h5>

                        <span>Current summary</span>

                    </div>

                </div>


                <div class="quick-info">

                    <div class="quick-item">

                        <div>
                            <i class="bi bi-tags"></i>
                            Categories
                        </div>

                        <strong id="total_categories">
                            0
                        </strong>

                    </div>


                    <div class="quick-item">

                        <div>
                            <i class="bi bi-cash-stack"></i>
                            Revenue
                        </div>

                        <strong id="sidebar_revenue">
                            Rp 0
                        </strong>

                    </div>


                    <div class="quick-item">

                        <div>
                            <i class="bi bi-people"></i>
                            Users
                        </div>

                        <strong id="sidebar_users">
                            0
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- RECENT ORDERS -->
    <div class="dashboard-card mt-4">

        <div class="dashboard-title">

            <div>

                <h5>Recent Orders</h5>

                <span>Latest transactions</span>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>

                    </tr>

                </thead>

                <tbody id="latestOrderTable">

                </tbody>

            </table>

        </div>

    </div>

</div>


<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>