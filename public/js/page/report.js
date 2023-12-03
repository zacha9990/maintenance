function fetchDataAndReplaceSection() {
    var idValue = $("#factory_id").val();
    var noLaporan = $("#no_laporan");
    var noLaporanVal = noLaporan.val();

    $.ajax({
        url: getFactoryByIdRoute + idValue,
        method: 'GET',
        data: {},
        success: function (response) {
            handleSuccessResponse(response, noLaporan, noLaporanVal);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function handleSuccessResponse(response, noLaporan, noLaporanVal) {
    console.log(response.data);
    let code = response.data.letter_number;
    noLaporan.val(replaceSectionInNoLaporan(noLaporanVal, code));
}

let replaceSectionInNoLaporan = (noLaporanVal, code) => {
    var sections = noLaporanVal.split('/');

    if (sections.length === 4) {
        sections[2] = code;

        var replacedValue = sections.join('/');

        return replacedValue;
    } else {
        console.error('Invalid noLaporanVal format');
        return noLaporanVal; // Return the original value if the format is not as expected
    }
}

$(document).ready(function () {
    fetchDataAndReplaceSection();
});

$(document).on('change', '#factory_id', function(){
    fetchDataAndReplaceSection();
});