<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            
            width: 400px;
            padding: 10%;
            max-width: 100%;
            transition: 0.5s ;
        }
        .container:hover{
            box-shadow: 12px 12px 12px rgba(0, 0, 0, 0.1) , -10px -10px 10px white inset;
           
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input:focus {
            outline: none;
        }
        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: rgba(0, 0, 0, 0.927);
            color: #ffffff;
            border: none;
            padding: 12px 35px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: auto;
            font-weight: 500;
            transition: 0.3s;
            border: 1px solid white;
        }
        input[type="submit"]:hover {
            background-color: #000000;
        }
        input[type="submit"]:focus {
            background-color: transparent;
            color: rgb(0, 0, 0);
            border-color: #000000;
            font-weight: 600;
        }
      
   

    </style>
</head>
<body>
    


    <div class="container">
        <h1>Submit Your Information</h1>
        <form action="process_form.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"  >

            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  >

            <label for="pdf">Upload PDF:</label>
            <input type="file" id="pdf" name="pdf" accept=".pdf"  >

            <label for="photo">Upload Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*"  >

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
