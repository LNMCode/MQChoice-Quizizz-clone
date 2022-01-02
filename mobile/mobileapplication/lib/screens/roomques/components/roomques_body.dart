import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/components/counter_timer_linear.dart';
import 'package:mobileapplication/components/rounded_button.dart';
import 'package:mobileapplication/models/getroom/question.dart';
import 'package:mobileapplication/models/getroom/room.dart';
import 'package:mobileapplication/screens/roomques/blocs/question/question_bloc.dart';
import 'package:mobileapplication/screens/roomques/blocs/question/question_event.dart';
import 'package:mobileapplication/screens/roomques/blocs/question/question_state.dart';
import 'package:mobileapplication/screens/waitroom_finish/waitroom_finish_screen.dart';

class RoomQuesBody extends StatefulWidget {
  final Room room;
  final String iduser;
  const RoomQuesBody({
    Key? key,
    required this.room,
    required this.iduser,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _RoomQuesBody();
}

class _RoomQuesBody extends State<RoomQuesBody> {
  late bool _isButtonDisabled;
  late int _positionCurrentPage;
  late int _numberOfQuestion;
  bool _isStopCountTimer = false;

  @override
  void initState() {
    super.initState();
    _isButtonDisabled = false;
    _positionCurrentPage = 1;
    _numberOfQuestion = widget.room.data.length;

    BlocProvider.of<QuestionBloc>(context).add(QuestionConnectSocket(
      widget.room.idroom,
      widget.iduser,
    ));
  }

  @override
  Widget build(BuildContext context) {
    final PageController pageController = PageController();
    Size size = MediaQuery.of(context).size;
    var timeDurationChangePage = 1; // seconds

    return Scaffold(
      resizeToAvoidBottomInset: false,
      body: BlocConsumer<QuestionBloc, QuestionState>(
        listener: (context, state) {
          if (state is QuestionAnswerSuccess) {
            // Add animation for check answer in room
            setState(() {
              _isButtonDisabled = false;
              _positionCurrentPage++;
            });

            print("${_positionCurrentPage} / ${_numberOfQuestion}");
          }
          if (state is QuestionAnswerNextQuestion) {
            setState(() {
              _isStopCountTimer = false;
            });
            if (_positionCurrentPage > _numberOfQuestion) {
              print('Change to waitroom finish screen');
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) {
                  return WaitRoomFinishScreen(
                    idroom: widget.room.idroom,
                    iduser: widget.iduser,
                  );
                }),
              );
            }
            pageController.nextPage(
                duration: Duration(seconds: timeDurationChangePage),
                curve: Curves.easeInOutQuart);
          }
        },
        builder: (context, state) {
          if (widget.room != null) {
            return PageView(
              physics: NeverScrollableScrollPhysics(),
              controller: pageController,
              scrollDirection: Axis.horizontal,
              children: _getListQuestion(
                size: size,
                onSubmitted: (idasn, valueans, idques, isCorrect) {
                  setState(() {
                    _isButtonDisabled = true;
                    _isStopCountTimer = true;
                  });
                  _submittedAnswer(
                    context: context,
                    idques: idques,
                    idasn: idasn,
                    valueans: valueans,
                    isCorrect: isCorrect,
                    onNext: () {
                      Navigator.pop(context);
                      BlocProvider.of<QuestionBloc>(context)
                          .add(QuestionEventNextQuestion());
                    },
                  );
                },
              ),
            );
          }
          return Container(
            child: const Center(
              child: Text('Something were wrong'),
            ),
          );
        },
      ),
    );
  }

  List<Widget> _getListQuestion({
    required Size size,
    required Function(String, String, String, bool) onSubmitted,
  }) {
    List<Widget> childs = [];
    for (final ques in widget.room.data) {
      var container = Container(
        decoration: const BoxDecoration(
          image: DecorationImage(
            image: AssetImage("assets/images/background-2.jpg"),
            fit: BoxFit.cover,
          ),
        ),
        width: size.width,
        child: Column(
          children: [
            CounterTimerLinear(
              width: size.width,
              time: int.parse(ques.time),
              isStop: _isStopCountTimer,
              onFinish: () {
                onSubmitted(
                  'null',
                  'null',
                  ques.idques,
                  false,
                );
              },
            ),
            SizedBox(
              width: size.width,
              height: size.height * 0.4,
              child: Container(
                color: Colors.black.withOpacity(0.6),
                padding: const EdgeInsets.symmetric(vertical: 10),
                margin: const EdgeInsets.all(8),
                alignment: Alignment.center,
                child: Text(
                  ques.valueques,
                  style: const TextStyle(
                    fontSize: 18,
                    color: Colors.white,
                  ),
                ),
              ),
            ),
            Column(
              children: _getListAnsOfQuestion(
                ques: ques,
                onPress: (idans, valueans) {
                  onSubmitted(
                    idans,
                    valueans,
                    ques.idques,
                    ques.correct == idans,
                  );
                },
              ),
            )
          ],
        ),
      );
      childs.add(container);
    }
    return childs;
  }

  List<Widget> _getListAnsOfQuestion({
    required Question ques,
    required Function(String, String) onPress,
  }) {
    List<Widget> childs = [];
    for (final ans in ques.ans) {
      childs.add(
        RoundedButton(
          color: color_v2_map[ans.color_v2] ?? color_v2_primary,
          textColor: Colors.white,
          text: ans.valueans,
          margin: const EdgeInsets.symmetric(vertical: 5, horizontal: 15),
          press: _isButtonDisabled
              ? null
              : () {
                  onPress(ans.idans, ans.valueans);
                },
        ),
      );
    }
    return childs;
  }

  _submittedAnswer({
    required BuildContext context,
    required String idques,
    required String idasn,
    required String valueans,
    required bool isCorrect,
    required Function() onNext,
  }) {
    _showModalBottomSheet(
      context,
      isCorrect,
      onNext,
    );
    BlocProvider.of<QuestionBloc>(context).add(
      QuestionWasAnswer(
        widget.room.idroom,
        widget.iduser,
        idques,
        idasn,
        valueans,
        isCorrect,
      ),
    );
  }

  _showModalBottomSheet(
    BuildContext context,
    bool isCorrect,
    Function() onNext,
  ) {
    showModalBottomSheet(
      context: context,
      enableDrag: false,
      isDismissible: false,
      builder: (context) {
        Size size = MediaQuery.of(context).size;
        return Container(
          height: size.height * 0.15,
          decoration: BoxDecoration(
            color: isCorrect ? correctColor : inCorrectColor,
          ),
          child: Column(
            children: [
              CounterTimerLinear(
                isStop: false,
                width: size.width,
                time: 5,
                color: Colors.yellowAccent,
                onFinish: onNext,
              ),
              Container(
                padding: EdgeInsets.only(top: 25),
                child: Text(
                  isCorrect ? 'Correct' : 'Incorrect',
                  textAlign: TextAlign.center,
                  style: const TextStyle(
                    fontSize: 20,
                    color: Colors.white,
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
            ],
          ),
        );
      },
    );
  }
}
