<?php
require __DIR__ . '/../vendor/autoload.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ALGO PROPOSAL</title>
</head>
<body>
<nav class="navbar navbar-light bg-light mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://algosd.com">algosd</a>
    </div>
</nav>

<div class="container" x-data="dropdown()">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-4">Search Form</h5>
            <div class="row mb-5">
                <div class="col-md-6">
                    <label for="first" class="form-label">First Name</label>
                    <input x-model="firstName" type="text" class="form-control" id="first" placeholder="John">
                </div>
                <div class="col-md-6">
                    <label for="last" class="form-label">Last Name</label>
                    <input x-model="lastName" type="text" class="form-control" id="last" placeholder="Doe">
                </div>
            </div>
            <button @click="search()" type="button" class="btn btn-primary">SEARCH</button>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Search Results</h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Forenames</th>
                    <th scope="col">Service</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                <template x-for="item in results">
                    <tr>
                        <td x-text="item.Forenames"></td>
                        <td x-text="item.Service"></td>
                        <td x-text="item.Surname"></td>
                        <td x-text="item.Date"></td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!-- Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.4.2/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function dropdown() {
        return {
            firstName: '',
            lastName: '',
            results: [],
            async search() {
                const data = new FormData();
                data.append('first_name', this.firstName);
                data.append('last_name', this.lastName);

                const response = await axios.post('/api.php', data);

                this.results = response.data;
            },
        }
    }
</script>
</body>
</html>