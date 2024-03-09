<template>
  <div>
    <h1>Cadastrar despesa</h1>

    <form>
      <div>
        <label for="value">Valor:</label>
        <input type="number" name="value" />
      </div>

      <div>
        <label for="category">Catergoria:</label>
        <select name="category">
          <option value="">Selecione...</option>
        </select>
      </div>

      <div>
        <label for="description">Descrição:</label>
        <textarea name="description"></textarea>
      </div>

      <button type="submit">Cadastrar</button>
    </form>

    <hr />

    <TransactionsTable />
  </div>
</template>
