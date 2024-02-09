<html>

<head>
    <title>
        <?= $name ?> view
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</head>

<body>
    <div id='container'>
        <form method='post' action='/Person/complete_registration'>
            <div class="form-group">
                <label>First Name: <input type="text" class="form-control" name="first_name"
                        placeholder="John" /></label>
            </div>
            <div class="form-group">
                <label>Last Name: <input type="text" class="form-control" name="last_name" placeholder="Doe" /></label>
            </div>
            <div class="form-group">
                <label>Email address: <input type="email" class="form-control" name="email"
                        placeholder="johndoe@email.com" /></label>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="publications[]" value="mailing_list" />Include me on the
                    mailing</label>
                <label><input type="checkbox" name="publications[]" value="weekly_flyer" />Send me the weekly
                    flyer</label>
            </div>
            <div class="form-group">
                <input type="submit" name="action" value="Register" />
            </div>
        </form>
    </div>