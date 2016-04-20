jQuery(document).ready(function ($) {
    $("#people").on("submit", function (event) {
        var $dataJSON;

        event.preventDefault();

        setErrorMessage("");

        $dataJSON = convertFormDataToJSON($(this).serializeArray());

        $.ajax({
            "type": "POST",
            "url": "index.php",
            "data": JSON.stringify($dataJSON),
            "dataType": "json"
        }).done(function (data) {
            if (data.success) {
                loadPeople();
            } else {
                setErrorMessage(data.message);
            }
        })
        .fail(function () {
            setErrorMessage("Something went wrong trying to save the form, please try again.");
        });
    });

    function convertFormDataToJSON($formDataSerialised) {
        var people = [];

        for (var i = 0; i < $formDataSerialised.length; i += 3) {
            people.push({
                "firstname": $formDataSerialised[i].value,
                "surname": $formDataSerialised[i + 1].value,
                "jobTitle": $formDataSerialised[i + 2].value
            });
        }

        return people;
    }

    function setErrorMessage(message) {
        $("#form-error")
            .empty()
            .append(message);
    }

    function loadPeople() {
        $.ajax({
            "type": "GET",
            "url": "index.php",
            "data": {
                "action": "getpeople"
            },
            "dataType": "json"
        }).done(function (data) {
            var template,
                renderedHTML;

            if (!data.success) {
                setErrorMessage(data.message);
                return;
            }

            template = $("#template").html();
            data.people.push({
                "firstname": "",
                "surname": "",
                "jobTitle": ""
            });

            Mustache.parse(template);
            renderedHTML  = Mustache.render(template, {"people": data.people});
            $("#people").find("table tbody")
                .empty()
                .append(renderedHTML);
        })
        .fail(function () {
            setErrorMessage("Something went wrong trying to load data, try again.");
        });
    }

    loadPeople();
});