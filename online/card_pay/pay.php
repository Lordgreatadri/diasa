<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Demo Integration of MIGS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            background:#dedede;
        }

        .container{
            width: 30%;
            margin:90px auto;
            background:#ffffff;
            border: 1px solid #c0c0c0;
            padding: 50px;
            border-radius: 6px;
            min-height: auto;
        }

    </style>
    
</head>
<body>

        <div class="container">

            <form action="process_order.php" method="POST">
                <input type="hidden" name="order" value="1">
                <label> Select an item</label>
                <select name="item">
                    <option value="rice-bag"> Rice Bag ($20.25) </option>
                    <option value="sugar"> Sugar ($10.00) </option>
                    <option value="milk"> Milk ($20.10) </option>
                    <option value="beans"> Beans ($23.00) </option>
                </select>
                <button type="submit">Submit and pay</button>
            </form>

        </div>
    
</body>
</html>