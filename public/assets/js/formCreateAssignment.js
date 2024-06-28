function doChange(type, element)
{
    if (type === "essay") {
        element[0].disabled = true;
        element[1].disabled = true;
        element[2].disabled = true;
        element[3].disabled = true;

        element[0].classList.add('bg-gray-200');
        element[1].classList.add('bg-gray-200');
        element[2].classList.add('bg-gray-200');
        element[3].classList.add('bg-gray-200');
    } else {
        element[0].disabled = false;
        element[1].disabled = false;
        element[2].disabled = false;
        element[3].disabled = false;

        element[0].classList.remove('bg-gray-200');
        element[1].classList.remove('bg-gray-200');
        element[2].classList.remove('bg-gray-200');
        element[3].classList.remove('bg-gray-200');
    }
}

function changeType(id)
{
    var type = document.getElementById(id+'_type').value;
    var list = [
        document.getElementById(id+'_option1'),
        document.getElementById(id+'_option2'),
        document.getElementById(id+'_option3'),
        document.getElementById(id+'_correctAnswer')
    ]
    doChange(type, list);
}

document.addEventListener('DOMContentLoaded', () => {
    var list = document.getElementsByName('type');
    list.forEach(element => {
        doChange(element.value, [
            document.getElementById(element.id[0]+'_option1'),
            document.getElementById(element.id[0]+'_option2'),
            document.getElementById(element.id[0]+'_option3'),
            document.getElementById(element.id[0]+'_correctAnswer')
        ]);
    });
});
