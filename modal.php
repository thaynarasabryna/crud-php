<!-- Modal -->
<div class="modal fade" id="modalExemplo-<?php echo $_POST['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir <strong><?php echo $_POST['nome']; ?></strong>?</p>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                <form action="actions.php" method="POST">
                    <input type="hidden" name="id_excluir" value="<?php echo $_POST['id']; ?>">
                    <input type="submit" class="btn btn-danger" value="Sim">
                </form>
            </div>
        </div>
    </div>
</div>
