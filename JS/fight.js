








function startingFight(player, enemy) {
    let turnNumber = 1;    
    while (true) {
        console.log(`--- Turn ${turnNumber} ---`);

        break;
    }
}

function decideTurnOrder(player, enemy) {
    let initP = Math.floor(Math.random() * 6) + 1 + player.initiative;
    let initE = Math.floor(Math.random() * 6) + 1 + enemy.initiative;
    return (initP >= initE) ? 'player' : 'enemy';
}

function playerTurn(player, enemy) {}

function enemyTurn(enemy, player) {}

function attackP(attacker, defender) {
    let defense = Math.floor(Math.random() * 7) + Math.floor(defender.strength / 2) + (defender.armor?.defense || 0);
    let damage = Math.floor(Math.random() * 7) + attacker.strength + (attacker.weapon?.damage || 0);
    damage = Math.max(0, damage - defense);
    defender.pv -= damage;
    console.log(`${attacker.name} attacks ${defender.name} for ${damage} damage!`);
    return {damage, defenderPv: defender.pv};
}

function attackM(attacker, defender, spell) {
    if (attacker.mana < spell.manaCost) {
        console.log(`${attacker.name} does not have enough mana to cast ${spell.name}!`);
        return {success: false, message: 'Not enough mana'};
    }
    attacker.mana -= spell.manaCost;
    let damage = Math.floor(Math.random() * 7) + Math.floor(Math.random() * 7) + spell.damage;
    defender.pv -= damage;
    console.log(`${attacker.name} casts ${spell.name} on ${defender.name} for ${damage} damage!`);
    return {success: true, damage, defenderPv: defender.pv, attackerMana: attacker.mana};
}

function useItem(user, item) {}

function turnEnd(player, enemy) {}

function checkVictory(player, enemy) {}


