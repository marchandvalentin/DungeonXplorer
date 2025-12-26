// Combat state variables
let hero, monster, chapterId, turnCount, isPlayerTurn;

/**
 * Determines who gets the first turn in combat.
 * Rolls a d6 for each combatant and adds their initiative.
 * Player wins ties.
 * @param {Object} player - The player character
 * @param {Object} enemy - The enemy monster
 * @returns {string} 'player' or 'enemy'
 */
function firstturnOrder(player, enemy) {
    let initP = Math.floor(Math.random() * 6) + 1 + player.initiative;
    let initE = Math.floor(Math.random() * 6) + 1 + enemy.initiative;
    return (initP >= initE) ? 'player' : 'enemy';
}

/**
 * Determines turn order. After the first turn, alternates between player and enemy.
 * @param {Object} player - The player character
 * @param {Object} enemy - The enemy monster
 * @returns {string} 'player' or 'enemy'
 */
function decideTurnOrder(player, enemy) {
    if(turnCount > 1) {
        return isPlayerTurn ? 'player' : 'enemy';
    }
    return firstturnOrder(player, enemy);
}

/**
 * Calculates a physical attack.
 * Defense = d6 + (defender.strength/2) + armor bonus
 * Damage = d6 + attacker.strength + weapon bonus
 * Final damage = max(0, damage - defense)
 * @param {Object} attacker - The attacking character
 * @param {Object} defender - The defending character
 * @returns {Object} {damage, defenderPv}
 */
function attackP(attacker, defender) {
    let defense = Math.floor(Math.random() * 7) + Math.floor(defender.strength / 2) + (defender.armor?.defense || 0);
    let damage = Math.floor(Math.random() * 7) + attacker.strength + (attacker.weapon?.damage || 0);
    damage = Math.max(0, damage - defense);
    defender.pv -= damage;
    return {damage, defenderPv: defender.pv};
}

/**
 * Calculates a magic attack.
 * Checks if attacker has enough mana, then deals 2d6 + spell damage.
 * @param {Object} attacker - The attacking character
 * @param {Object} defender - The defending character
 * @param {Object} spell - The spell being cast {manaCost, damage}
 * @returns {Object} {success, damage, defenderPv, attackerMana} or {success: false, message}
 */
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

/**
 * Initializes the combat system with hero and monster data.
 * Sets up global combat variables and prepares for battle.
 * @param {Object} heroData - Hero stats (id, name, pv, maxPv, mana, maxMana, strength, initiative)
 * @param {Object} monsterData - Monster stats (name, pv, maxPv, mana, maxMana, strength, initiative)
 * @param {number} currentChapterId - The ID of the current chapter
 */
function initializeCombat(heroData, monsterData, currentChapterId) {
    hero = heroData;
    monster = monsterData;
    chapterId = currentChapterId;
    turnCount = 0;
    isPlayerTurn = true;
}

/**
 * Adds a message to the combat log with color coding.
 * @param {string} message - The message to display
 * @param {string} type - Message type: 'damage' (red), 'heal' (green), 'normal' (cream)
 */
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
    if (!isPlayerTurn) {
        return;
    }

    const result = attackP(hero, monster);
    addLog(`${hero.name} attaque et inflige ${result.damage} dégâts!`, 'damage');
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
        const result = attackP(monster, hero);
        addLog(`${monster.name} attaque et inflige ${result.damage} dégâts!`, 'damage');
        updateStats();
        
        if (checkFightEnd()) return;
        
        isPlayerTurn = true;
    }, 1000);
}

/**
 * Checks if the fight has ended (either combatant reached 0 PV).
 * Displays the result screen if fight is over.
 * @returns {boolean} True if fight ended, false otherwise
 */
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

/**
 * Displays the victory or defeat screen.
 * Hides action buttons and shows result modal with appropriate message.
 * @param {boolean} victory - True if player won, false if player lost
 */
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

/**
 * Saves the combat result to the server via AJAX.
 * Sends hero stats and victory status to /fight/result endpoint.
 * @param {boolean} victory - True if player won, false if player lost
 * @returns {Promise} Fetch promise
 */
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

/**
 * Handles the "Continue" button after fight ends.
 * Saves combat result and redirects back to chapter view.
 */
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
    initializeCombat(window.heroData, window.monsterData, window.currentChapterId);
    
    // Attach event listeners
    const attackBtn = document.getElementById('btn-attack');
    const magicBtn = document.getElementById('btn-magic');
    const fleeBtn = document.getElementById('btn-flee');
    

    if (attackBtn && magicBtn && fleeBtn) {
        attackBtn.addEventListener('click', function() {
            playerAttack();
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
    }
}