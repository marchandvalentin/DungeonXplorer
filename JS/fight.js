








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

// Combat system functions
let hero, monster, chapterId, turnCount, isPlayerTurn;

function initializeCombat(heroData, monsterData, currentChapterId) {
    hero = heroData;
    monster = monsterData;
    chapterId = currentChapterId;
    turnCount = 0;
    isPlayerTurn = true;
}

function addLog(message, type = 'normal') {
    const log = document.getElementById('combat-log');
    const p = document.createElement('p');
    p.className = type === 'damage' ? 'text-red-400' : type === 'heal' ? 'text-green-400' : 'text-medieval-cream/80';
    p.textContent = message;
    log.appendChild(p);
    log.scrollTop = log.scrollHeight;
}

function updateStats() {
    // Update hero
    document.getElementById('hero-pv').textContent = hero.pv;
    document.getElementById('hero-mana').textContent = hero.mana;
    const heroPvPercent = (hero.pv / hero.maxPv) * 100;
    const heroManaPercent = (hero.mana / hero.maxMana) * 100;
    document.getElementById('hero-pv-bar').style.width = heroPvPercent + '%';
    document.getElementById('hero-mana-bar').style.width = heroManaPercent + '%';

    // Update monster
    document.getElementById('monster-pv').textContent = monster.pv;
    document.getElementById('monster-mana').textContent = monster.mana;
    const monsterPvPercent = (monster.pv / monster.maxPv) * 100;
    const monsterManaPercent = (monster.mana / monster.maxMana) * 100;
    document.getElementById('monster-pv-bar').style.width = monsterPvPercent + '%';
    document.getElementById('monster-mana-bar').style.width = monsterManaPercent + '%';
}

function playerAttack() {
    console.log('Player chooses to attack.');
    if (!isPlayerTurn) {
        console.log('Ce n\'est pas le tour du joueur.');
        return;
    }

    const result = attackP(hero, monster);
    addLog(`${hero.name} attaque et inflige ${result.damage} dégâts!`, 'damage');
    updateStats();
    
    if (checkFightEnd()){
        console.log('Le combat est terminé.');
        return;
    }
    
    isPlayerTurn = false;
    setTimeout(enemyTurn, 1500);
}

function playerMagicAttack() {
    if (!isPlayerTurn) return;
    
    const spell = { name: 'Boule de Feu', damage: 15, manaCost: 10 };
    const result = attackM(hero, monster, spell);
    
    if (!result.success) {
        addLog(`${hero.name} n'a pas assez de mana!`, 'normal');
        return;
    }
    
    addLog(`${hero.name} lance ${spell.name} et inflige ${result.damage} dégâts!`, 'damage');
    updateStats();
    
    if (checkFightEnd()) return;
    
    isPlayerTurn = false;
    setTimeout(enemyTurn, 1500);
}

function enemyTurn() {
    addLog(`C'est au tour de ${monster.name}...`, 'normal');
    
    setTimeout(() => {
        const result = attackP(monster, hero);
        addLog(`${monster.name} attaque et inflige ${result.damage} dégâts!`, 'damage');
        updateStats();
        
        if (checkFightEnd()) return;
        
        isPlayerTurn = true;
    }, 1000);
}

function checkFightEnd() {
    if (monster.pv <= 0) {
        showResult(true);
        return true;
    }
    if (hero.pv <= 0) {
        showResult(false);
        return true;
    }
    return false;
}

function showResult(victory) {
    document.getElementById('action-buttons').classList.add('hidden');
    const resultScreen = document.getElementById('result-screen');
    const resultTitle = document.getElementById('result-title');
    const resultMessage = document.getElementById('result-message');
    
    if (victory) {
        resultTitle.textContent = '🎉 Victoire! 🎉';
        resultTitle.className = 'text-5xl font-bold mb-6 text-yellow-400';
        resultMessage.textContent = `Vous avez vaincu ${monster.name}!`;
    } else {
        resultTitle.textContent = '💀 Défaite 💀';
        resultTitle.className = 'text-5xl font-bold mb-6 text-red-400';
        resultMessage.textContent = `Vous avez été vaincu par ${monster.name}...`;
    }
    
    resultScreen.classList.remove('hidden');
    
    // Save combat result to server
    saveCombatResult(victory);
}

function saveCombatResult(victory) {
    // Send AJAX request to save hero stats and combat result
    fetch('/fight/result', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            hero_id: hero.id,
            chapter_id: chapterId,
            victory: victory,
            remaining_pv: hero.pv,
            remaining_mana: hero.mana
        })
    });
}

function continueAfterFight() {
    window.location.href = `/chapter/${hero.id}/${chapterId}`;
}

function flee() {
    if (confirm('Êtes-vous sûr de vouloir fuir le combat?')) {
        window.location.href = `/heros`;
    }
}

function startCombat() {
    addLog('⚔️ Le combat commence!', 'normal');
    const firstTurn = decideTurnOrder(hero, monster);
    if (firstTurn === 'enemy') {
        isPlayerTurn = false;
        addLog(`${monster.name} a l'initiative!`, 'normal');
        setTimeout(enemyTurn, 2000);
    } else {
        addLog(`${hero.name} a l'initiative!`, 'normal');
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    if (window.heroData && window.monsterData && window.currentChapterId !== undefined) {
        initializeCombat(window.heroData, window.monsterData, window.currentChapterId);
        
        // Attach event listeners
        document.getElementById('btn-attack').addEventListener('click', playerAttack);
        document.getElementById('btn-magic').addEventListener('click', playerMagicAttack);
        document.getElementById('btn-flee').addEventListener('click', flee);
        
        startCombat();
    }
});

