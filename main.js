//URL Informations: tabs=Id's&active=id
const BaseUrl = "/backend/"
var Content = {} 
/*
Content = {
    EntityID: {
        ID: EntityID,
        Parent: [EntityID],
        Children: [EntityID],
        Data: {
            language: {
                name:

                Data contained here :D
            }
        }
    }
}
*/

function init() {
    $.get(BaseUrl + "getEntity.php", (data)=>{
        let baseRawData = JSON.parse(data);
        let baseLanguage = baseRawData["title"]["@language"];
        let baseRelease = baseRawData["releaseId"];
        let baseEntity = {
            "ID": 0,
            "Parent": [],
            "Children": [],
            "Data": {
                baseLanguage: {
                    baseRelease: {
                        "name": baseRawData["title"]["@value"],
                    }
                }
            }
        };

        baseRawData["child"].forEach(child => {
            let idRaw = child.split("/")
            let id = idRaw[idRaw.length - 1]
            baseEntity["Children"].push(id);
            LoadEntity(id, 0);
        });

        Content[0] = baseEntity;
    });
}

function LoadEntity(id, parentId, fullEntity=false, release, language) {
    if (Content[id]==undefined) {
        Content[id] = {
            "ID": id,
            "Parent": [parentId],
            "Children": [],
            "Data": {}
        }
    }



    getEntity(id, ()=>{

    }, fullEntity, )
}

function getEntity(id, callback, fullEntity=false, release, language) {
    let submitData = {};
    // ID checken
    if (id == "" || isNaN(id)) {
        alert("Die Anfrage an den Server war fehlerhaft. Es muss eine ID angefordert werden.");
        return;
    } 
    //ID okay
    submitData["entityId"] = id;
    if (fullEntity) {
        submitData["fullEntity"] = true;
    } 
    // Release (vorläufig Undefined)
    // Language (vorläufig Undefined)

    $.get(BaseUrl + "getEntity.php", submitData, (data)=>{
        alert(data);
        callback(JSON.parse(data));
    });
}

function getTreeview(parentId) {

}

function ExpandTreeview(parentId) {

}

function LoadTreeview(parentId) {
    $.get()
}

init()