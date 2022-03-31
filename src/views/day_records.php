<main class="content">
    <?php
        renderTitle(
            'Registrar Ponto',
            'Mantenha seu ponto consistente!',
            'icofont-check-alt'
        );
        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <div class="card">
        <div class="card-header">
            <h3><?= $today ?></h3>
            <p class="mb-0">Os batimentos efetuados hoje</p>
        </div>
        <div class="card-body">
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 1: <?= $workingHours->time1 ?? '---' ?></span>
                <span class="record">Saída 1: <?= $workingHours->time2 ?? '---' ?></span>
            </div>
            <div class="d-flex m-5 justify-content-around">
                <span class="record">Entrada 2: <?= $workingHours->time3 ?? '---' ?></span>
                <span class="record">Saída 2: <?= $workingHours->time4 ?? '---' ?></span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="innout.php" class="btn btn-success btn-lg">
                <i class="icofont-check mr-1"></i>
                Bater o Ponto
            </a>
        </div>
    </div>

    <form class="mt-5" action="innout.php" method="post">
        <?php if($user->is_admin): ?>
        <div class="form-row">
            <div class="form-group col-md-3">
                <select name="user" class="form-control mr-2" placeholder="Selecione o usuário...">
                    <option value="">Selecione o usuário</option>
                    <?php
							foreach($users as $user) {
                                $selected = $user->id === $selectedUserId ? 'selected' : '';
								echo "<option value='{$user->id}' {$selected}>{$user->name}</option>";
							}
                            ?>
					</select>
                </div>
                <div class="form-group col-md-3">
                
                <input type="date" id="start_date" name="start_date"
                    class="form-control <?= $errors['start_date'] ? 'is-invalid' : '' ?>"
                    value="<?= $start_date ?>">
                <div class="invalid-feedback">
                    <?= $errors['start_date'] ?>
                </div>
				</select>
            </div>
            <div class="form-group col-md-3">
                <input type="text" name="forcedTime" class="form-control"
                placeholder="Informe a hora para abono dos batimentos">
            </div> 
                <div class="form-group col-md-3">
            <button class="btn btn-danger ml-3">
                Abono de Ponto
            </button>
            <?php endif ?>
        </div>
        </div>
        </div>
    </form>

</main>