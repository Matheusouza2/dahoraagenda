const currencyFormatter = new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
});

const submit = (form, endpoint) => {
    console.log(API_URL);
    if (!validateForm(form)) {
        return false;
    }

    $("input[name=_method]").val() == ""
        ? $("input[name=_method]").val("POST")
        : "";

    let formData = new FormData();
    $.each($(`.${form} .form-control`), function (i, obj) {
        //Salva todos os campos de texto, number, etc.
        if ($(obj).hasClass("multiple")) {
            formData.append(obj.name, $(obj).select2("val"));
        } else if ($(obj).attr("type") == "file") {
            console.log(obj);
            formData.append(obj.name, $(obj)[0].files[0]);
        } else {
            formData.append(obj.name, obj.value);
        }
    });

    $.each($(`.${form} .btn-check`), function (i, obj) {
        //Salvar todos os campos que for Button Check
        if ($(obj).is(":checked")) {
            formData.append(obj.name, obj.value);
        }
    });

    $.each($(`.${form} .form-check-input`), function (i, obj) {
        //Salva todos os checkboxs e radios
        if ($(obj).is(":checked")) {
            formData.append(obj.name, obj.value);
        }
    });

    $.each($(`.${form} .ql-editor`), function (i, obj) {
        //Salva todos os QuillJS editors, desde que os mesmo possuam o data-bs-name que representa o nome do campo na tabela
        formData.append($(this).parent().attr("data-bs-name"), $(this).html());
    });

    $.each(
        $(`.table[data-ar-table-submit="true"] tbody tr td`),
        function (i, obj) {
            if ($(this).attr("data-ar-input") !== undefined) {
                formData.append(
                    $(this).attr("data-ar-input"),
                    $(this).attr("data-ar-value")
                );
            }
        }
    );

    $.ajax({
        url: `${API_URL}/${endpoint}`,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            modalShow();
        },
        success: function (data) {
            modalHide();
            clearInputs(`${form}`);
            Toast.fire({
                title: data.message,
                icon: "success",
            });

            redrawTable();
        },
        error: function (err) {
            errorTreat(err);
        },
    });
};

const clearInputs = (form) => {
    $.each($(`.${form} .form-control`), function (i, obj) {
        if ($(obj).hasClass("multiple")) {
            $(obj).val("");
            $(obj).trigger("change");
        } else if ($(obj).hasClass("select2-hidden-accessible")) {
            $(obj).val("").trigger("change");
        } else {
            $(obj).val("");
        }
    });
};

const deleteModel = (cod, endpoint, title) => {
    Swal.fire({
        title: `${title}`,
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(`/api/${endpoint}/${cod}`, {
                headers: {
                    Authorization: `Bearer ${getCookie("_plainToken")}`,
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch((error) => {
                    Swal.showValidationMessage(`A requisição falhou: ${error}`);
                });
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            redrawTable();
            Swal.fire({
                title: result.value.message,
                icon: "success",
            });
        }
    });
};

const validateForm = (form) => {
    $(`.${form}`).validate({
        errorPlacement: function errorPlacement(error, element) {
            var $parent = $(element).parents(".error-placeholder");

            if ($parent.find(".jquery-validation-error").length) {
                return;
            }
            $parent.append(
                error.addClass(
                    "jquery-validation-error small form-text invalid-feedback"
                )
            );
        },
        highlight: function (element) {
            var $el = $(element);
            var $parent = $el.parents(".error-placeholder");
            $el.addClass("is-invalid");
            if (
                $el.hasClass("select2-hidden-accessible") ||
                $el.attr("data-role") === "tagsinput"
            ) {
                $el.parent().addClass("is-invalid");
            }
        },
        unhighlight: function (element) {
            $(element)
                .parents(".error-placeholder")
                .find(".is-invalid")
                .removeClass("is-invalid")
                .addClass("is-valid");
        },
    });

    $(`.${form}`).on("submit", function (e) {
        e.preventDefault();
    });

    $(`.${form}`).trigger("submit");

    return $(`.${form}`).valid();
};

const redrawTable = () => {
    if ($.fn.DataTable.isDataTable(".dataTable")) {
        $(".dataTable").DataTable().ajax.reload();
    }
};

const modalOnClose = (el, text, formClass) => {
    const myModalEl = document.getElementById(el);

    myModalEl.addEventListener("hidden.bs.modal", (event) => {
        $(`#${el} .modal-title`).text(text);
        clearInputs(formClass);
    });
};

const errorTreat = (err) => {
    modalHide();
    let error = err.responseJSON;
    if (error != undefined) {
        if (error.errors) {
            Object.keys(error.errors).forEach(function (key) {
                Toast.fire({
                    title: error.errors[key],
                    icon: "error",
                });
            });
        } else {
            let msg = err.responseJSON.error
                ? err.responseJSON.error
                : err.responseJSON.message;
            Toast.fire({
                title: msg,
                icon: "error",
            });
        }
    } else {
        Toast.fire({
            title: "Erro não reconhecido, contate o suporte!",
            icon: "error",
        });
    }
};

window.submit = submit;
window.clearInputs = clearInputs;
window.modalOnClose = modalOnClose;
window.deleteModel = deleteModel;
window.redrawTable = redrawTable;
window.errorTreat = errorTreat;
window.currencyFormatter = currencyFormatter;
