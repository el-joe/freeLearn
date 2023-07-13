function question(index,question = undefined){
    var Qtype = question ? question.type : 'image';

    var template = '';

    if(Qtype == 'text'){
        template = textQ(index,question);
    }else{
        template = imageQ(index,question);
    }

    var selectionsTemplate = '';

    if(question){
        question.options?.forEach((selection,_index) => {
            selectionsTemplate += qSelection(index,_index+1,selection);
        });
    }

    return `
        <div class="panel panel-default singleQuestion q-${index}" index="${index}">
            <div class="panel-heading">
                Question ${index}
                <a href="javascript:" class="btn btn-danger btn-xs pull-right" onclick="removeQuestion(event,${index})">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="form-group col-sm-3" onchange="questionTypeEvent(event,${index})">
                    <label for="question_type">Question Type</label>
                    <select name="question[${index}][type]" id="question_type" class="form-control">
                        <option value="image" ${Qtype == 'image' ? 'selected' : ''}>Image</option>
                        <option value="text" ${Qtype == 'text' ? 'selected' : ''}>Text</option>
                    </select>
                </div>
                <div class="q-template">
                    ${template}
                </div>
                <br><br>
                <a href="javascript:" class="btn btn-primary col-sm-12" onclick="addNewS(event)">New Selection</a>
                <div class="selections col-sm-12">
                    ${selectionsTemplate}
                </div>
                <div class="form-group col-sm-12">
                    <label for="answer">Answer</label>
                    <input type="number" name="question[${index}][answer]" value="${question?.answer}" class="form-control" placeholder="Enter Answer">
                </div>
            </div>
        </div>
    `;
}

function removeQuestion(event,index) {
    $(event.currentTarget).parents('.q-'+index).eq(0).remove();
}
function removeSelection(event,index) {
    $(event.currentTarget).parents('.selection-'+index).eq(0).remove();
}


function addNewS(event) {
    var qIndex = $(event.currentTarget).parents('.singleQuestion').eq(0).attr('index');
    var selections = $(event.currentTarget).parent().find('.selections');
    var lastIndex = selections.find('.singleSelection').last().attr('index');
    var length = lastIndex ? parseInt(lastIndex) + 1 : 1;
    $(selections).append(qSelection(qIndex,length));

}

function textQ(index , question = undefined) {
    return `
    <div class="form-group col-sm-9 text-q">
        <label for="question">Question</label>
        <input type="text" name="question[${index}][source]" id="question" value="${question?.source}" class="form-control" placeholder="Enter Question">
    </div>
    `;
}

function imageQ(index ,question = undefined) {
    return `
        <div class="form-group col-sm-7 image-q">
            <label for="question">Question</label>
            <input type="file" name="question[${index}][source]" id="question" class="form-control">
        </div>
        <div class="form-group col-sm-2 image-q">
            <a class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="showImage('${question.source}')" style="margin-top: 23px">
                Current Image
            </a>
        </div>
    `;
}

function textS(qIndex , sIndex , selection = undefined) {
    return `
    <div class="form-group col-sm-9 text-s">
        <label for="selection">Selection</label>
        <input type="text" name="question[${qIndex}][selection][${sIndex}][source]" id="selection" value="${selection?.source}" class="form-control" placeholder="Enter Selection">
    </div>
    `;
}

function imageS(qIndex , sIndex ,selection = undefined) {
    return `
        <div class="form-group col-sm-7 image-s">
            <label for="selection">Selection</label>
            <input type="file" name="question[${qIndex}][selection][${sIndex}][source]" id="selection" class="form-control">
        </div>
        <div class="form-group col-sm-2 image-s">
            <a class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="showImage('${selection.source}')" style="margin-top: 23px">
                Current Image
            </a>
        </div>
    `;
}

function qSelection(qIndex,sIndex,selection = undefined) {

    var Stype = selection ? selection.type : 'image';

    var template = '';

    if(Stype == 'text'){
        template = textS(qIndex,sIndex,selection);
    }else{
        template = imageS(qIndex,sIndex,selection);
    }

    return `
        <div class="panel panel-default selection-${sIndex} singleSelection" index="${sIndex}">
            <div class="panel-heading">
                Selection ${sIndex}
                <a href="javascript:" class="btn btn-danger btn-xs pull-right" onclick="removeSelection(event,${sIndex})">
                    <i class="fa fa-trash"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="form-group col-sm-3">
                    <label for="selection_type">Selection Type</label>
                    <select name="question[${qIndex}][selection][${sIndex}][type]" onchange="selectionTypeEvent(event,${qIndex},${sIndex})" id="selection_type" class="form-control">
                        <option value="image" ${Stype == 'image' ? 'selected' : ''}>Image</option>
                        <option value="text" ${Stype == 'text' ? 'selected' : ''}>Text</option>
                    </select>
                </div>
                <div class="s-template">
                    ${template}
                </div>
            </div>
        </div>
    `;
}

function questionTypeEvent(event,index) {
    var elem = $(event.currentTarget);
    var type = elem.find('option:selected').val();
    $(elem).parents('.panel-body').eq(0).find(`.q-template`).empty().append(type == 'text' ? textQ(index) : imageQ(index));
}

function selectionTypeEvent(event,qIndex,sIndex) {
    var elem = $(event.currentTarget);
    var type = elem.find('option:selected').val();
    $(elem).parents('.panel-body').eq(0).find(`.s-template`).empty().append(type == 'text' ? textS(qIndex,sIndex) : imageS(qIndex,sIndex));
}

function addNewQ(){
    var _questions = $('.questions');
    var lastIndex = _questions.find('.singleQuestion').last().attr('index');
    var index = lastIndex ? parseInt(lastIndex) + 1 : 1;
    _questions.append(question(index));
}

function showImage(image) {
    $('#myModal .modal-body').empty().append(`<img src="${image}" class="img-responsive">`);
}

state.questions.map((questionObj,index)=>{
    $('.questions').append(question(index+1,questionObj));
});
