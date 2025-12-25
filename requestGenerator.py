# ---------------------------------- IMPORTS --------------------------------- #
import json
import os


# --------------------------------- FUNCTIONS -------------------------------- #
def create_file(filename, content=""):
    """
    Create a new file with the specified content
    
    Args:
        filename (str): Name of the file to create
        content (str): Content to write to the file
    """
    try:
        with open(filename, 'w') as f:
            f.write(content)
        print(f"File '{filename}' created successfully!")
    except Exception as e:
        print(f"Error creating file: {e}")

def loadJson(filePath):
    """
        Load a JSON file and return its content as a dictionary.
        
        Attributes:
            filePath (str): The path to the JSON file.
        
        Returns:
            The content of the JSON file as a dictionary.
    """
    with open(filePath, 'r', encoding='utf-8') as file:
        return json.load(file)

def getInsertInChapters(id, content, titre):
    """
    Docstring for getInsertInChapters
    
    Attributes:
        id (int): The ID of the chapter.
        content (str): The content of the chapter.
        titre (str): The title of the chapter.

    Returns:
        str: The SQL insert statement for the Chapter table.
    """
    # Escape single quotes and display \n literally (not as line break)
    content = content.replace("'", "''").replace("\n", "\\n")
    titre = titre.replace("'", "''")
    return "insert into Chapter (id, titre, content, image) values ({}, '{}', '{}', NULL);".format(id, titre, content)

def getInsertInLinks(chapter_id, next_chapter_id, description):
    """
    Docstring for getInsertInLinks
    Attributes:
        chapter_id (int): The ID of the current chapter.
        next_chapter_id (int): The ID of the next chapter.
        description (str): The description of the link.
    Returns:
        str: The SQL insert statement for the Link table.
    """
    # Escape single quotes for SQL
    description = description.replace("'", "''")
    return "insert into Links (chapter_id, next_chapter_id, description) values ({}, {}, '{}');".format(chapter_id, next_chapter_id, description)

def getInsertInMonster(name):
    """
    Docstring for getInsertInMonster
    Attributes:
        name (str): The name of the monster.
    Returns:
        str: The SQL insert statement for the Monster table. All value fields except name are set to 0. TO BE UPDATED LATER IN THE DATABASE.
    """
    # Escape single quotes for SQL
    name = name.replace("'", "''")
    return "insert into Monster (name, pv, mana, initiative, strength, attack, xp, isboss) values ('{}', 0, 0, 0, 0, 0, 0, 0);".format(name)

def getInsertInEncounter(chapter_id, monster_id):
    """
    Docstring for getInsertInEncounter
    Attributes:
        chapter_id (int): The ID of the chapter.
        monster_id (int): The ID of the monster.
    Returns:
        str: The SQL insert statement for the Encounter table.
    """
    return "insert into Encounter (chapter_id, monster_id) values ({}, {});".format(chapter_id, monster_id)

def getInsertImagePathForChapter(chapter_id, image_path):
    """
    Docstring for getInsertImagePathForChapter
    Attributes:
        chapter_id (int): The ID of the chapter.
        image_path (str): The path to the image.
    Returns:
        str: The SQL update statement to set the image path for a chapter.
    """
    # Escape single quotes for SQL
    image_path = image_path.replace("'", "''")
    return "update Chapter set image = '{}' where id = {};".format(image_path, chapter_id)

def generateAllChapterInserts():
    """
    Docstring for generateAllChapterInserts
    Returns:
        str: All SQL insert statements for chapters, links, monsters, and encounters.
    """

    file_path =  input("Enter the path to the JSON file: ")
    data = loadJson(file_path)
    strChapters = ""
    strLinks = ""
    strMonsters = ""
    strEncounters = ""
    encountered = []

    for(chapter) in data['adventure']['chapters']:

        strChapters += getInsertInChapters(chapter['id'], chapter['text'], chapter['title']) + "\n"
        chapter_id = chapter['id']
        if('choices' in chapter):
            for(link) in chapter['choices']:
                strLinks += getInsertInLinks(chapter_id, link['next'], link['text']) + "\n"
        if('encounter' in chapter):
            encounter = chapter['encounter']
            monster_name = encounter['enemy']
            if monster_name not in encountered:
                encountered.append(monster_name)
                strMonsters += getInsertInMonster(monster_name) + "\n"
                
            strEncounters += getInsertInEncounter(chapter_id, f"(SELECT id FROM Monster WHERE name = '{monster_name.replace("'", "''")}')" ) + "\n"

    str = "-- INSERTS FOR CHAPTERS --\n" + strChapters + "\n-- INSERTS FOR LINKS --\n" + strLinks + "\n-- INSERTS FOR MONSTERS --\n" + strMonsters + "\n-- INSERTS FOR ENCOUNTERS --\n" + strEncounters
    return str

def generateAllImagePathInserts():
    """
    Docstring for generateAllImagePathInserts
    Returns:
        str: All SQL update statements for chapter image paths.
    """

    file_path =  input("Enter the path to the directory in which the images are stored: ")
    
    # Get the script's directory
    script_dir = os.path.dirname(os.path.abspath(__file__))
    
    # If path starts with / or \, treat as relative and strip it
    if file_path.startswith('/') or file_path.startswith('\\'):
        file_path = file_path.lstrip('/\\')
    
    # If not absolute path, make it relative to script directory
    if not os.path.isabs(file_path):
        file_path = os.path.join(script_dir, file_path)
    
    strInserts = ""

    for filename in os.listdir(file_path):
        full_path = os.path.join(file_path, filename)
        if os.path.isfile(full_path):
            chapter_id = filename[filename.find('_')+1:filename.rfind('.')]
            strInserts += getInsertImagePathForChapter(chapter_id, filename) + "\n"
        else:
            print(f"Skipping {full_path}, not a file.")
    return strInserts
# ----------------------------------- MAIN ----------------------------------- #
def main():
    os.system('cls' if os.name == 'nt' else 'clear')
    inserts = input("Generate insertions for Chapters(1) or Image Paths for Chapters(2)? ")
    if inserts == "1": 
        str = generateAllChapterInserts()
    elif inserts == "2":
        str = generateAllImagePathInserts()
    else:
        print("Invalid option selected.")
        return
    
    create_file("script.sql", str)

    
main()