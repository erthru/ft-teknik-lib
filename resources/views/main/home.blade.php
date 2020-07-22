@extends("main.layout")
@section("title", "Beranda")
@section("content")
    <div class="mt-3">
        <div class="card">
            <div class="card-body">
                <h3>Selamat Datang</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis facilisis dolor felis, et ultrices magna mattis vitae. Praesent sit amet iaculis diam. Maecenas metus elit, dictum ut porta eu, luctus at massa. Fusce id sapien sed dolor lobortis auctor sit amet in odio. Cras cursus porttitor feugiat. Proin sodales orci eget semper lacinia. Suspendisse potenti. Vestibulum et molestie tortor, a egestas enim. Nunc tempor felis at ligula dapibus vehicula. Pellentesque eget risus varius, tincidunt dolor at, ornare metus. Donec lacus lacus, laoreet vitae leo nec, semper consectetur leo. Phasellus consequat vitae sem vel suscipit. Mauris mi magna, tincidunt et urna blandit, malesuada aliquet purus.
                </p>
            </div>
        </div>

        <br />

        <div class="card">
            <div class="card-body">
                <h3>Buku/Skripsi</h3>
                <canvas id="chartItems" height="300"></canvas>
            </div>
        </div>
    </div>

    <script>
        const bookTotal = {!! json_encode($bookTotal) !!};
        const essayTotal = {!! json_encode($essayTotal) !!};
        const memberTotal = {!! json_encode($memberTotal) !!};

        const chartItems = document.getElementById('chartItems').getContext('2d');

        const dataItems = {
            labels: ["Buku", "Skripsi", "Anggota"],
            datasets: [{
                label: "Total",
                data: [bookTotal, essayTotal, memberTotal],
                borderWidth: 1,
                backgroundColor: ["rgba(0, 123, 255, 0.4)", "rgba(2, 75, 156, 0.4)", "rgba(0, 47, 99, 0.4)"]
            }]
        }

        const optionItems = {
            responsive: true,
            maintainAspectRatio: false
        }

        new Chart(chartItems, {
            type: "bar",
            data: dataItems,
            option: optionItems
        })
    </script>
@endsection
