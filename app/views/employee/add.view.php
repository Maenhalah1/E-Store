<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

    <div class="wrraper">
        <div class="page-slt">
                <form action="" method="post" class="form-emp-info">
                    <fieldset>
                        <legend>Employee Information</legend>
                        <div class="form-field">
                            <label for="name">Employee Name:</label>
                            <input type="text" name="name"  autocomplete>
                        </div>
                        <div class="form-field">
                            <label for="salary">Employee Salary:</label>
                            <input type="text" name="salary" autocomplete>
                        </div>
                        <div class="form-field">
                            <label for="tax">Employee Tax : </label>
                            <input type="text" name="tax" autocomplete>
                        </div>
                        <div class="form-field">
                            <label for="phone">Employee Number Phone:</label>
                            <input type="text" name="phone"  minlength="10" maxlength="10" autocomplete>
                        </div>
                        <div class="form-field">
                            <input type="submit" name="add" value="Save">
                        <div>
                    </fieldset>
                </form>
            </div>
    </div>

</body>
</html>