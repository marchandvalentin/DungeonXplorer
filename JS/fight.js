// Combat state variables
let hero, monster, chapterId, weapon1, weapon2, turnCount, isPlayerTurn;

function firstturnOrder(player, enemy) {
    let initP = Math.floor(Math.random() * 6) + 1 + player.initiative;
    let initE = Math.floor(Math.random() * 6) + 1 + enemy.initiative;
    if (hero.heroClass == 'voleur') 
        return (initP >= initE) ? 'player' : 'enemy';
    return (initP > initE) ? 'player' : 'enemy';
}

function decideTurnOrder(player, enemy) {
    if(turnCount > 1) {
        return isPlayerTurn ? 'player' : 'enemy';
    }
    return firstturnOrder(player, enemy);
}

function attackP(attacker, defender, weapon) {
    let defense = Math.floor(Math.random() * 7) + Math.floor(defender.strength / 2);
    let damage = Math.floor(Math.random() * 7) + attacker.strength + (weapon ? (weapon.effect ? weapon.effect : 0) : 0);
    damage = Math.max(0, damage - defense);
    defender.pv -= damage;
    return {damage, defenderPv: defender.pv};
}

function attackM(attacker, defender, spell) {
    if (attacker.mana < spell.manaCost) {
        return {success: false, message: 'Not enough mana'};
    }
    attacker.mana -= spell.manaCost;
    let damage = Math.floor(Math.random() * 7) + Math.floor(Math.random() * 7) + spell.damage;
    defender.pv -= damage;
    return {success: true, damage, defenderPv: defender.pv, attackerMana: attacker.mana};
}

function useItem(user, item) {}

function turnEnd(player, enemy) {}

function checkVictory(player, enemy) {}

// Combat system functions - initializeCombat will set these values
function initializeCombat(heroData, monsterData, currentChapterId, weapon1Param, weapon2Param) {
    hero = heroData;
    monster = monsterData;
    chapterId = currentChapterId;
    weapon1 = weapon1Param;
    weapon2 = weapon2Param;
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

function playerAttack(weapon) {
    if (!isPlayerTurn) {
        return;
    }

    const result = attackP(hero, monster, weapon);
    addLog(`${hero.name} attaque avec ${weapon.name} et inflige ${result.damage} dégâts!`, 'damage');
    updateStats();
    
    if (checkFightEnd()) {
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
        const result = attackP(monster, hero, null);
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
        
        // Store victory status for later save
        window.fightVictory = true;
    } else {
        resultTitle.textContent = '💀 Défaite 💀';
        resultTitle.className = 'text-5xl font-bold mb-6 text-red-400';
        resultMessage.textContent = `Vous avez été vaincu par ${monster.name}...`;
        
        window.fightVictory = false;
    }
    
    resultScreen.classList.remove('hidden');
}

function saveCombatResult(victory) {
    // Send AJAX request to save hero stats and combat result
    return fetch('/fight/result', {
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
    // Save result, then redirect
    saveCombatResult(window.fightVictory).then(() => {
        window.location.href = `/chapter/${hero.id}/${chapterId}`;
    });
}

function flee() {
    if (confirm('Êtes-vous sûr de vouloir fuir le combat?')) {
        window.location.href = `/heros`;
    }
}

function startCombat() {
    addLog('⚔️ Le combat commence!', 'normal');
    turnCount += 1;
    isPlayerTurn = decideTurnOrder(hero, monster) === 'player';
    if (!isPlayerTurn) {
        addLog(`${monster.name} a l'initiative!`, 'normal');
        setTimeout(enemyTurn, 2000);
    } else {
        addLog(`${hero.name} a l'initiative!`, 'normal');
    }
}

// Auto-initialize - DOM is already loaded since script is at end of body
if (window.heroData && window.monsterData && window.currentChapterId !== undefined) {
    console.log('Initializing combat...');
    initializeCombat(window.heroData, window.monsterData, window.currentChapterId, window.weapon1, window.weapon2);
    
    // Attach event listeners
    const attackBtnPrimary = document.getElementById('btn-primary-weapon');
    const attackBtnSecondary = document.getElementById('btn-secondary-weapon');
    const magicBtn = document.getElementById('btn-magic');
    const fleeBtn = document.getElementById('btn-flee');
    
    console.log('Buttons found:', {
        primary: attackBtnPrimary,
        secondary: attackBtnSecondary,
        magic: magicBtn,
        flee: fleeBtn
    });
    
    if (attackBtnPrimary && attackBtnSecondary && magicBtn && fleeBtn) {
        console.log('All buttons found, attaching event listeners...');
        attackBtnPrimary.addEventListener('click', function() {
            console.log('Primary weapon attack');
            playerAttack(weapon1);
        });
        attackBtnSecondary.addEventListener('click', function() {
            console.log('Secondary weapon attack');
            playerAttack(weapon2);
        });
        magicBtn.addEventListener('click', function() {
            console.log('Magic attack');
            playerMagicAttack();
        });
        fleeBtn.addEventListener('click', function() {
            console.log('Flee attempt');
            flee();
        });
        
        startCombat();
    } else {
        console.error('Some buttons are missing!');
    }
} else {
    console.error('Missing combat data:', {
        heroData: window.heroData,
        monsterData: window.monsterData,
        chapterId: window.currentChapterId,
        weapon1: window.weapon1,
        weapon2: window.weapon2
    });
}

