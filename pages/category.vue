<template>
  <div>
    <h1>Cadastrar categoria</h1>

    <form>
      <div>
        <label for="name">Nome:</label>
        <input type="text" name="name" />
      </div>

      <div>
        <label><input type="radio" />Despesa</label>
        <label><input type="radio" />Receita</label>
      </div>

      <button type="submit">Cadastrar</button>
    </form>
  </div>
</template>
