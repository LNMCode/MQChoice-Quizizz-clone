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
  @override
  void initState() {
    super.initState();
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
            pageController.nextPage(
                duration: Duration(seconds: timeDurationChangePage),
                curve: Curves.easeInOutQuart);
          }
        },
        builder: (context, state) {
          if (widget.room != null && state is QuestionAnswerConnectSuccess) {
            return PageView(
              physics: NeverScrollableScrollPhysics(),
              controller: pageController,
              scrollDirection: Axis.horizontal,
              children: _getListQuestion(
                size: size,
                onSubmitted: (idasn, valueans, idques) {
                  _submittedAnswer(context, idques, idasn, valueans);
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
    required Function(String, String, String) onSubmitted,
  }) {
    List<Widget> childs = [];
    for (final ques in widget.room.data) {
      var container = Container(
        width: size.width,
        child: Column(
          children: [
            CounterTimerLinear(
              size: size,
              time: int.parse(ques.time),
              onFinish: () {
                onSubmitted(
                  'null',
                  'null',
                  ques.idques,
                );
              },
            ),
            SizedBox(
              width: size.width,
              height: size.height * 0.4,
              child: Container(
                padding: const EdgeInsets.symmetric(vertical: 10),
                alignment: Alignment.center,
                child: Text(
                  ques.valueques,
                  style: const TextStyle(
                    fontSize: 18,
                    color: Colors.black87,
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
          press: () {
            onPress(ans.idans, ans.valueans);
          },
        ),
      );
    }
    return childs;
  }

  _submittedAnswer(
    BuildContext context,
    String idques,
    String idasn,
    String valueans,
  ) {
    BlocProvider.of<QuestionBloc>(context).add(
      QuestionWasAnswer(
        widget.room.idroom,
        widget.iduser,
        idques,
        idasn,
        valueans,
      ),
    );
  }
}
