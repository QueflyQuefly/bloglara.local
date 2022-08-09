<form id="bigSearch" action="" method="GET">
    <div class="input-group mb-3  input-group-lg">
        <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="Введите поисковый запрос" 
            aria-label="Введите поисковый запрос" 
            aria-describedby="button-addon2" 
            value="{{ $search }}"
            spellcheck="true"
            maxlength="120"
            required
        >
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Поиск</button>
    </div>
</form>
<style>
    #navSearch {
        display: none;
    }
</style>