let modal = null;

const modalConsultaInit = () => {
    $(".row-modal-message").html(`
        <i class="fa-solid fa-circle fs-6 fa-beat-fade"></i>
        <h5 class="mt-3">
            Aguarde enquanto carregamos alguns dados...
        </h5>
    `);
};

const modalInserirDadosInit = () => {
    $(".row-modal-message").html(`
        <i class="fa-solid fa-cog fs-6 fa-spin"></i>
        <h5 class="mt-3">
            Salvando informações...
        </h5>
    `);
};

const modalInit = () => {
    if (modal == null) {
        modal = new Modal(document.getElementById("modalMessage"), {
            keybord: false,
        });
    }
};

window.modalShow = (typeModal) => {
    if (typeModal == "consulta") {
        modalConsultaInit();
    } else {
        modalInserirDadosInit();
    }
    modal.show();
};

window.modalHide = () => {
    setTimeout(() => {
        modal.hide();
    }, 500);
};

modalInit();
