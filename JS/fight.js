








function startingFight(player, enemy) {
    let turnNumber = 1;    
    while (true) {
        console.log(`--- Turn ${turnNumber} ---`);

        break;
    }
}

function decideTurnOrder(player, enemy) {
    let initP = Math.random() + player.initiative;
    let initE = Math.random() + enemy.initiative;
    return (initP >= initE) ? 'player' : 'enemy';
}

function playerTurn(player, enemy) {}

function enemyTurn(enemy, player) {}

function attackP(attacker, defender) {
    let defense = Math.random()%7 + (int)(defender.strength / 2) + defender.armor.defense;
    let damage = Math.random()%7 + attacker.strength + attacker.weapon.damage;
    damage = Math.max(0, damage - defense);
    defender.pv -= damage;
    console.log(`${attacker.name} attacks ${defender.name} for ${damage} damage!`);
    return 0;
}

function attackM(attacker, defender, spell) {
    if (attacker.mana < spell.manaCost) {
        console.log(`${attacker.name} does not have enough mana to cast ${spell.name}!`);
        return -1;
    }
    attacker.mana -= spell.manaCost;
    let damage = ((Math.random()%7) + (Math.random()%7)) + spell.damage;
    defender.pv -= damage;
    console.log(`${attacker.name} casts ${spell.name} on ${defender.name} for ${damage} damage!`);
    return 0;
}

function useItem(user, item) {}

function turnEnd(player, enemy) {}

function checkVictory(player, enemy) {}


