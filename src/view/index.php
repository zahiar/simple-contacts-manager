<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Simple Contacts Manager</title>
    </head>

    <body>
        <div id="form-error"></div>

        <form id="people" action="index.php" method="post">
            <table>
                <thead>
                    <tr>
                        <td>First name</td>
                        <td>Last name</td>
                        <td>Job title</td>
                    </tr>
                </thead>

                <tbody></tbody>
            </table>

            <input type="submit" value="OK" />
        </form>

        <script id="template" type="x-tmpl-mustache">
            {{#people}}
            <tr>
                <td><input type="text" name="people[{{@index}}][firstname]" value="{{firstname}}" /></td>
                <td><input type="text" name="people[{{@index}}][surname]" value="{{surname}}" /></td>
                <td><input type="text" name="people[{{@index}}][jobtitle]" value="{{jobTitle}}" /></td>
            </tr>
            {{/people}}
        </script>

        <script src="/view/js/libs/jquery-1.11.3.min.js"></script>
        <script src="/view/js/libs/mustache.min.js"></script>
        <script src="/view/js/form.js"></script>
    </body>
</html>