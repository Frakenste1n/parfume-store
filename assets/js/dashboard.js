$(document).ready(function () {

    loadDashboard();

});


function loadDashboard()
{

    $.ajax({

        url: base_url + "api/dashboard",

        type: "GET",

        dataType: "json",

        success: function (res)
        {

            if (!res.success)
            {
                return;
            }

            let data = res.data;


            // CARD
            $("#total_users").text(numberFormat(data.total_users));

            $("#total_brands").text(numberFormat(data.total_brands));

            $("#total_products").text(numberFormat(data.total_products));

            $("#total_orders").text(numberFormat(data.total_orders));

            $("#total_categories").text(numberFormat(data.total_categories));



            $("#total_revenue").text(
                rupiah(data.total_revenue)
            );

            $("#sidebar_revenue").text(
                rupiah(data.total_revenue)
            );

            $("#sidebar_users").text(
                numberFormat(data.total_users)
            );


            renderLatestOrders(data.latest_orders);

            renderChart(data);

        },

        error: function (xhr) {

            console.log(xhr.responseText);

        }

    });

}



function renderLatestOrders(orders)
{

    let html = "";

    if (orders.length === 0)
    {

        html += `

        <tr>

            <td colspan="5" class="text-center text-secondary py-5">

                Belum ada transaksi

            </td>

        </tr>

        `;

    }
    else
    {

        $.each(orders, function (i, item) {

            const paymentStatus = item.payment_status || 'pending';
            const statusClass = paymentStatus === 'paid' ? 'paid' : (paymentStatus === 'failed' ? 'failed' : (paymentStatus === 'cancelled' ? 'cancelled' : 'pending'));

            html += `

            <tr>

                <td>

                    #${item.id}

                </td>

                <td>

                    ${item.name}

                </td>

                <td>

                    ${rupiah(item.grand_total || item.subtotal || 0)}

                </td>

                <td>

                    <span class="status ${statusClass}">

                        ${capitalize(paymentStatus)}

                    </span>

                </td>

                <td>

                    ${formatDate(item.created_at)}

                </td>

            </tr>

            `;

        });

    }

    $("#latestOrderTable").html(html);

}



let chartInstance = null;


function renderChart(data)
{

    if (chartInstance != null)
    {
        chartInstance.destroy();
    }

    const ctx = document
        .getElementById('orderChart')
        .getContext('2d');


    let gradient = ctx.createLinearGradient(
        0,
        0,
        0,
        350
    );


    gradient.addColorStop(
        0,
        "rgba(99,102,241,.35)"
    );

    gradient.addColorStop(
        1,
        "rgba(99,102,241,0)"
    );



    chartInstance = new Chart(ctx, {

        type: "line",

        data: {

            labels: [

                "Users",
                "Brands",
                "Categories",
                "Products",
                "Orders"

            ],

            datasets: [

                {

                    label: "Analytics",

                    data: [

                        data.total_users,

                        data.total_brands,

                        data.total_categories,

                        data.total_products,

                        data.total_orders

                    ],

                    borderWidth: 4,

                    fill: true,

                    backgroundColor: gradient,

                    tension: .45,

                    pointRadius: 6,

                    pointHoverRadius: 8,

                    pointBackgroundColor: "#6366f1",

                    borderColor: "#6366f1"

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: false

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    grid: {

                        color: "#f1f5f9"

                    }

                },

                x: {

                    grid: {

                        display: false

                    }

                }

            }

        }

    });

}



function rupiah(angka)
{

    return "Rp " + Number(angka)
        .toLocaleString(
            "id-ID"
        );

}


function numberFormat(angka)
{

    return Number(angka)
        .toLocaleString(
            "id-ID"
        );

}



function capitalize(str)
{

    return str.charAt(0).toUpperCase() +
        str.slice(1);

}

function formatDate(value) {
    if (!value) return "-";
    const date = new Date(String(value).replace(" ", "T"));
    if (isNaN(date.getTime())) return value;
    return date.toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "short",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit"
    });
}